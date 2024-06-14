(()=>{"use strict";var e={n:t=>{var n=t&&t.__esModule?()=>t.default:()=>t;return e.d(n,{a:n}),n},d:(t,n)=>{for(var l in n)e.o(n,l)&&!e.o(t,l)&&Object.defineProperty(t,l,{enumerable:!0,get:n[l]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t)};const t=window.wp.element,n=window.wp.apiFetch;var l=e.n(n);const i=window.wp.components,a=window.wp.blockEditor;wp.blocks.registerBlockType("ageofqueenstheme/slide",{title:"AgeOfQueens-Slide",supports:{align:["full"]},attributes:{align:{type:"string",default:"full"},imgID:{type:"number"},imgURL:{type:"string",default:"/wp-content/themes/ageofqueenstheme/assets/images/placeholder.png"},isActive:{type:"boolean",default:!1}},edit:function(e){return(0,t.useEffect)((function(){!async function(){const t=await l()({path:`/wp/v2/media/${e.attributes.imgID}`,method:"GET"});console.log(t),e.setAttributes({imgURL:t.source_url})}()}),[e.attributes.imgID]),(0,t.createElement)(t.Fragment,null,(0,t.createElement)(a.InspectorControls,null,(0,t.createElement)(i.PanelBody,{title:"Background",initialOpen:!0},(0,t.createElement)(i.PanelRow,null,(0,t.createElement)(a.MediaUploadCheck,null,(0,t.createElement)(a.MediaUpload,{onSelect:function(t){e.setAttributes({imgID:t.id})},value:e.attributes.imgID,render:e=>{let{open:n}=e;return(0,t.createElement)(i.Button,{onClick:n},"Choose Image")}})))),(0,t.createElement)(i.PanelBody,{title:"Slide Options"},(0,t.createElement)(i.PanelRow,null,(0,t.createElement)(i.CheckboxControl,{label:"Active slide",help:"One slide needs to be active.",checked:e.attributes.isActive,onChange:function(t){e.setAttributes({isActive:t})}})))),(0,t.createElement)("div",{className:"slide"},(0,t.createElement)("img",{className:"slide__img",src:e.attributes.imgURL}),(0,t.createElement)("div",{className:"slide__content"},(0,t.createElement)(a.InnerBlocks,null))))},save:function(){return(0,t.createElement)(a.InnerBlocks.Content,null)}})})();