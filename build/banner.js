(()=>{"use strict";var e={n:t=>{var n=t&&t.__esModule?()=>t.default:()=>t;return e.d(n,{a:n}),n},d:(t,n)=>{for(var a in n)e.o(n,a)&&!e.o(t,a)&&Object.defineProperty(t,a,{enumerable:!0,get:n[a]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t)};const t=window.wp.element,n=window.wp.apiFetch;var a=e.n(n);const l=window.wp.components,r=window.wp.blockEditor;wp.blocks.registerBlockType("ageofqueenstheme/banner",{title:"AgeOfQueens-Banner",supports:{align:["full"]},attributes:{align:{type:"string",default:"full"},imgID:{type:"number"},imgURL:{type:"string",default:"/wp-content/themes/ageofqueenstheme/assets/images/placeholder.png"}},edit:function(e){return(0,t.useEffect)((function(){!async function(){const t=await a()({path:`/wp/v2/media/${e.attributes.imgID}`,method:"GET"});console.log(t),e.setAttributes({imgURL:t.media_details.sizes.full.source_url})}()}),[e.attributes.imgID]),(0,t.createElement)(t.Fragment,null,(0,t.createElement)(r.InspectorControls,null,(0,t.createElement)(l.PanelBody,{title:"Background",initialOpen:!0},(0,t.createElement)(l.PanelRow,null,(0,t.createElement)(r.MediaUploadCheck,null,(0,t.createElement)(r.MediaUpload,{onSelect:function(t){e.setAttributes({imgID:t.id})},value:e.attributes.imgID,render:e=>{let{open:n}=e;return(0,t.createElement)(l.Button,{onClick:n},"Choose Image")}}))))),(0,t.createElement)("div",{className:"page-banner"},(0,t.createElement)("div",{className:"page-banner__bg-image",style:{backgroundImage:`url('${e.attributes.imgURL}')`}}),(0,t.createElement)("h1",{className:"headline headline--large d-none"},"Welcome!"),(0,t.createElement)("div",{className:"page-banner__content"},(0,t.createElement)(r.InnerBlocks,{allowedBlocks:["core/paragraph","core/heading","core/list","ageofqueenstheme/heading","ageofqueenstheme/button"]}))))},save:function(){return(0,t.createElement)(r.InnerBlocks.Content,null)}})})();