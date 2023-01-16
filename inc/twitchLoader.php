<?php

class TwitchLoader {

	public string $accessToken = '';

	public string $tokenUrl = "https://id.twitch.tv/oauth2/token";
	public string $validationUrl = "https://id.twitch.tv/oauth2/validate";
	public string $baseApiUrl = "https://api.twitch.tv/helix";
	public string $twitchTeamUrl = "https://api.twitch.tv/helix/teams?name=";

	public TwitchTeam $twitchTeam;

	function __construct() {
		// TODO: Somehow store the current access token
		if(!$this->isAccessTokenValid($this->accessToken)) {
			$this->updateAccessToken();
		}

		$this->twitchTeam = $this->getTwitchTeam("ageofqueens");
		$this->twitchTeam->members = $this->getTwitchTeamMembers($this->twitchTeam->memberIds);

	}

	function getTwitchTeam($teamName): ?TwitchTeam {
		$request = Requests::get($this->twitchTeamUrl . $teamName, array(
			'Authorization' => 'Bearer ' . $this->accessToken,
			'Client-ID' => TWITCH_CLIENT_ID,
			'Content-Type' => 'application/json'
		));

		if(!$request->success) return null;

		$data = json_decode($request->body, true)['data'][0];
		//$data = $arr['data'][0];

		// Saving the Twitch team
		$twitchTeam = new TwitchTeam($data['background_image_url'],
			$data['banner'],
			$data['created_at'],
			$data['updated_at'],
			$data['info'],
			$data['team_name'],
			$data['team_display_name'],
			$data['id'],
			$data['thumbnail_url']
		);

		// Saving all Twitch team members to an array
		foreach($data['users'] as $user){
			$twitchTeam->memberIds[] = $user['user_id'];
		}
		return $twitchTeam;
	}

	function getTwitchTeamMembers($ids):array {

		// Url structure must begin without & at the beginning
		$query = $ids[0];
		for($i = 1; $i < count($ids); $i++){
			$query .= "&id={$ids[$i]}";
		}
		$url = "{$this->baseApiUrl}/users?{$query}";

		$request = Requests::get($url, array(
			'Authorization' => 'Bearer ' . $this->accessToken,
			'Client-ID' => TWITCH_CLIENT_ID,
			'Content-Type' => 'application/json'
		));

		if(!$request->success) return [];

		$data = json_decode($request->body, true)['data'];
		$members = [];
		foreach($data as $user){
			$member = new TwitchTeamMember(
				$user['broadcaster_type'],
				$user['description'],
				$user['display_name'],
				$user['id'],
				$user['login'],
				$user['offline_image_url'],
				$user['profile_image_url'],
				$user['type'],
				$user['view_count'],
				$user['created_at']
			);
			$members[] = $member;
		}
		return $members;
	}

	// TODO: Check what it returns if valid
	function isAccessTokenValid($accessToken): bool {
		if(empty($accessToken)) return false;

		$request = Requests::post($this->validationUrl, array(
			'Authorization' => 'Bearer ' . $this->accessToken,
			'Content-Type' => 'application/json'
		));

		if(!$request->success) return false;
		return false;
	}

	function updateAccessToken(): bool {
		$url = $this->tokenUrl . '?client_id=' . TWITCH_CLIENT_ID . '&client_secret=' . TWITCH_CLIENT_SECRET . '&grant_type=client_credentials';

		$request = Requests::post($url);

		if(!$request->success) return false;

		$data = json_decode($request->body, true);
		$this->accessToken = $data["access_token"];
		print_r($this->accessToken);
		return true;
	}

}

class TwitchTeam {

	public string $backgroundImageUrl;
	public string $bannerUrl;
	public string $createdAt;
	public string $updatedAt;
	public string $info;
	public string $teamName;
	public string $teamDisplayName;
	public string $id;
	public string $thumbnailUrl;
	public array $memberIds;
	public array $members;

	function __construct($backgroundImageUrl, $bannerUrl, $createdAt, $updatedAt, $info, $teamName, $teamDisplayName, $id, $thumbnailUrl){
		$this->backgroundImageUrl = $backgroundImageUrl;
		$this->bannerUrl = $bannerUrl;
		$this->createdAt = $createdAt;
		$this->updatedAt = $updatedAt;
		$this->info = $info;
		$this->teamName = $teamName;
		$this->teamDisplayName = $teamDisplayName;
		$this->id = $id;
		$this->thumbnailUrl = $thumbnailUrl;
	}
}

class TwitchTeamMember {

	public string $broadcasterType;
	public string $description;
	public string $displayName;
	public string $id;
	public string $login;
	public string $offlineImageUrl;
	public string $profileImageUrl;
	public string $type;
	public string $viewCount;
	public string $createdAt;

	function __construct($broadcasterType, $description, $displayName, $id, $login, $offlineImageUrl, $profileImageUrl, $type, $viewCount, $createdAt) {
		$this->broadcasterType = $broadcasterType;
		$this->description = $description;
		$this->displayName = $displayName;
		$this->id = $id;
		$this->login = $login;
		$this->offlineImageUrl = $offlineImageUrl;
		$this->profileImageUrl = $profileImageUrl;
		$this->type = $type;
		$this->viewCount = $viewCount;
		$this->createdAt = $createdAt;
	}

}




