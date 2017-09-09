(function(){var a="autosave",D=false,z=false,A=false,n={"%":"%1","&":"%2",";":"%3","=":"%4","<":"%5"},E={"%1":"%","%2":"&","%3":";","%4":"=","%5":"<"},i=[],s={},g={},l="TinyAutoSave_Test_",b=null,p={dataKey:"TinyAutoSave",cookieFilter:null,saveDelegate:null,saveFinalDelegate:null,restoreDelegate:null,disposeDelegate:null,restoreImage:"",progressImage:"progress.gif",intervalSeconds:60,retentionMinutes:20,minSaveLength:50,askBeforeUnload:false,canRestore:false,busy:false,timer:null};try{localStorage.setItem(l,"OK");if(localStorage.getItem(l)==="OK"){localStorage.removeItem(l);D=true}}catch(x){try{sessionStorage.setItem(l,"OK");if(sessionStorage.getItem(l)==="OK"){sessionStorage.removeItem(l);z=true}}catch(x){A=tinymce.isIE}}tinymce.PluginManager.requireLangPack(a);tinymce.create("tinymce.plugins.AutoSavePlugin",{editor:null,url:"",key:"",onPreSave:null,onPostSave:null,onSaveError:null,onPreRestore:null,onPostRestore:null,onRestoreError:null,showSaveProgress:true,progressDisplayTime:1200,init:function(e,F){var G=this,I=tinymce.is,L=tinymce.resolve,H,K,J;if(A){if(!b){b=e.getElement()}b.style.behavior="url('#default#userData')"}G.editor=e;G.id=e.id;G.url=F;G.key=e.getParam(a+"_key",e.id);H=C(G);H.restoreImage=F+"/images/restore."+(tinymce.isIE6?"gif":"png");G.setProgressImage(F+"/images/"+p.progressImage);H.intervalSeconds=Math.max(1,parseInt(e.getParam(a+"_interval_seconds",null)||e.getParam(a+"_interval",H.intervalSeconds)));H.retentionMinutes=Math.max(1,parseInt(e.getParam(a+"_retention_minutes",null)||e.getParam(a+"_retention",H.retentionMinutes)));H.minSaveLength=Math.max(1,parseInt(e.getParam(a+"_minlength",H.minSaveLength)));G.showSaveProgress=e.getParam(a+"_showsaveprogress",G.showSaveProgress);H.askBeforeUnload=e.getParam(a+"_ask_beforeunload",H.askBeforeUnload);H.canRestore=G.hasSavedContent();H.saveDelegate=m(G,v);H.saveFinalDelegate=m(G,h);H.restoreDelegate=m(G,u);e.addCommand("mceAutoSave",H.saveDelegate);e.addCommand("mceAutoSaveRestore",H.restoreDelegate);e.addButton(a,{title:a+".restore_content",cmd:"mceAutoSaveRestore",image:H.restoreImage});H.timer=window.setInterval(H.saveDelegate,H.intervalSeconds*1000);tinymce.dom.Event.add(window,"unload",H.saveFinalDelegate);e.onRemove.add(H.saveFinalDelegate);e.onPostRender.add(function(N,M){N.controlManager.setDisabled(a,!H.canRestore)});K=e.getParam(a+"_oninit",null);if(I(K,"string")){J=L(K);if(I(J,"function")){J.apply(G)}}if(H.askBeforeUnload){tinymce.dom.Event.add(window,"unload",tinymce.plugins.AutoSavePlugin._beforeUnloadHandler)}},getInfo:function(){return{longname:"Auto save",author:"Moxiecode Systems AB",authorurl:"http://tinymce.moxiecode.com",infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/autosave",version:tinymce.majorVersion+"."+tinymce.minorVersion}},clear:function(){var F=this,e=F.editor,G=d(F);if(D){localStorage.removeItem(G.dataKey)}else{if(z){sessionStorage.removeItem(G.dataKey)}else{if(A){y(F)}else{tinymce.util.Cookie.remove(G.dataKey)}}}G.canRestore=false;e.controlManager.setDisabled(a,F)},hasSavedContent:function(){var H=this,I=d(H),F=new Date(),J,G;try{if(D||z){J=((D?localStorage.getItem(I.dataKey):sessionStorage.getItem(I.dataKey))||"").toString(),G=J.indexOf(",");if((G>8)&&(G<J.length-1)){if((new Date(J.slice(0,G)))>F){return true}if(D){localStorage.removeItem(I.dataKey)}else{sessionStorage.removeItem(I.dataKey)}}return false}else{if(A){return((k(H)||"").length>0)}}return((tinymce.util.Cookie.get(I.dataKey)||"").length>0)}catch(K){return false}},setProgressImage:function(e){if(tinymce.is(e,"string")){c(d(this).progressImage=e)}},"static":{_beforeUnloadHandler:function(){var e;tinymce.each(tinyMCE.editors,function(F){if(F.getParam("fullscreen_is_enabled")){return}if(F.isDirty()){e=F.getLang("autosave.unload_msg");return false}});return e}}});function B(){var e=this,F=d(e);if(F.timer){window.clearInterval(F.timer)}tinymce.dom.Event.remove(window,"unload",F.saveFinalDelegate);if(F.askBeforeUnload){tinymce.dom.Event.remove(window,"unload",tinymce.plugins.AutoSavePlugin._beforeUnloadHandler)}e.editor.onRemove.remove(F.saveFinalDelegate);j(e)}function o(H){if(!H){return true}var G,F,e=tinymce.is;if(e(H,"string")){G=g[H];if(G){F=G[H]}else{g[H]=F=tinymce.resolve(H)}}else{if(e(H,"function")){F=H}else{return true}}return F.apply(this)}function h(){var e=d(this);e.saveDelegate();e.disposeDelegate()}function v(){var Q=this,J=Q.editor,R=d(Q),I=tinymce.is,P=false,F=new Date(),L,G,N,M,O,H;if((J)&&(!R.busy)){R.busy=true;L=J.getContent();if(I(L,"string")&&(L.length>=R.minSaveLength)){if(!o.call(Q,Q.onPreSave)){R.busy=false;return false}G=new Date(F.getTime()+(R.retentionMinutes*60*1000));try{if(D){localStorage.setItem(R.dataKey,G.toString()+","+f(L))}else{if(z){sessionStorage.setItem(R.dataKey,G.toString()+","+f(L))}else{if(A){r(Q,L,G)}else{N=R.dataKey+"=";M="; expires="+G.toUTCString();document.cookie=N+t(L).slice(0,4096-N.length-M.length)+M}}}P=true}catch(K){o.call(Q,Q.onSaveError)}if(P){O=J.controlManager;R.canRestore=true;O.setDisabled(a,false);if(Q.showSaveProgress){M=tinymce.DOM.get(O.get(a).id);if(M){H=R.restoreImage;M.firstChild.src=R.progressImage;window.setTimeout(function(){M.firstChild.src=H},Math.min(Q.progressDisplayTime,R.intervalSeconds*1000-100))}}o.call(Q,Q.onPostSave)}}R.busy=false}return P}function u(){var I=this,G=I.editor,J=d(I),L=null,K=tinymce.is,H,F;if((G)&&(J.canRestore)&&(!J.busy)){J.busy=true;if(!o.call(I,I.onPreRestore)){J.busy=false;return}try{if(D||z){L=((D?localStorage.getItem(J.dataKey):sessionStorage.getItem(J.dataKey))||"").toString();H=L.indexOf(",");if(H==-1){L=null}else{L=q(L.slice(H+1,L.length))}}else{if(A){L=k(I)}else{F=J.cookieFilter.exec(document.cookie);if(F){L=w(F[1])}}}if(!K(L,"string")){G.windowManager.alert(a+".no_content")}else{if(G.getContent().replace(/\s|&nbsp;|<\/?p[^>]*>|<br[^>]*>/gi,"").length===0){G.setContent(L);o.call(I,I.onPostRestore)}else{G.windowManager.confirm(a+".warning_message",function(e){if(e){G.setContent(L);o.call(I,I.onPostRestore)}J.busy=false},I)}}}catch(M){o.call(I,I.onRestoreError)}J.busy=false}}function r(e,G,F){b.setAttribute(d(e).dataKey,G);b.expires=F.toUTCString();b.save("TinyMCE")}function k(e){b.load("TinyMCE");return b.getAttribute(d(e).dataKey)}function y(e){b.removeAttribute(d(e).dataKey)}function t(e){return e.replace(/[\x00-\x1f]+|&nbsp;|&#160;/gi," ").replace(/(.)\1{5,}|[%&;=<]/g,function(F){if(F.length>1){return("%0"+F.charAt(0)+F.length.toString()+"%")}return n[F]})}function w(e){return e.replace(/%[1-5]|%0(.)(\d+)%/g,function(K,F,J){var H,I,G;if(K.length==2){return E[K]}for(H=[],I=0,G=parseInt(J);I<G;I++){H.push(F)}return H.join("")})}function f(e){return e.replace(/,/g,"&#44;")}function q(e){return e.replace(/&#44;/g,",")}function c(F){var e=i.length;i[e]=new Image();i[e].src=F}function m(e,F){return function(){return F.apply(e)}}function C(G){var e=G.key,F=s[e];if(!F){F=s[e]=tinymce.extend({},p,{dataKey:p.dataKey+e,saveDelegate:m(G,v),saveFinalDelegate:m(G,h),restoreDelegate:m(G,u),disposeDelegate:m(G,B),cookieFilter:new RegExp("(?:^|;\\s*)"+p.dataKey+e+"=([^;]*)(?:;|$)","i")})}return F}function d(e){return s[e.key]}function j(e){delete s[e.key]}tinymce.PluginManager.add(a,tinymce.plugins.AutoSavePlugin)})();