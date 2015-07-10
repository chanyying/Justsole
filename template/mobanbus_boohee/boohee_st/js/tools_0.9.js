/**
 * @author tiger
 */



;(function(){
	Function.prototype.method = function(name,func){
		if(!this.prototype[name]){
			this.prototype[name] = func;
		}
	};
	if( !window.XMLHttpRequest && window.ActiveXObject){
	    try{
			document.execCommand('BackgroundImageCache', false, true);
		}catch (e){
		};
	}
/*
 * String
 */
	var str = {
		rgbtoHex : function(){
			var s = this.match(/\d{1,3}/g);
			if(!s) return null;
			if(s.length == 4 && s[3]==0) return 'transparent';
			var result = [];
			for(var i=0,l=s.length;i<l;i++){
				s[i] = (s[i]-0).toString(16);
				result.push(s[i].length==1 ? '0'+s[i] : s[i]);
			}
			return '#'+result.join('');
		},
		camelCase : function(){
			return this.replace(/-\D/g,function(m){return m.charAt(1).toUpperCase()})
		},
		hyphenate : function(){
			return this.replace(/[A-Z]/g,function(m){return '-'+m.charAt(0).toLowerCase()})
		}
	};
	
	for(var key in str){
		if(str.hasOwnProperty(key)){
			String.method(key,str[key]);
		}
	}
	
/*
 * Array
 */ 	
	
	
})();


/*
 * Element
 */
var Element = {
	create : function(){
		
	},
	hasClass:function(obj,name){
		return (' '+obj.className+' ').indexOf(' '+name+' ') > -1 ? true : false;
	},
	addClass : function(obj,name){
		if(this.hasClass(obj,name)) return;
		obj.className += ' ' + name;
	},
	removeClass : function(obj,name){
		obj.className = obj.className.replace(new RegExp('(^|\\s)' +name+ '(?:\\s|$)'),'$1').replace(/\s{1,}/g,' ');
	},
	getStyle : function(obj,style){
		
		var result;
		if(style == 'padding' || style=='margin'){
			result = '';
			for(var key in {top:0,right:0,bottom:0,left:0}){
				result += Element.getStyle(obj,style+'-'+key) + ' ';
			}
			result = result.replace(/\s$/,'');
			return result;
		}
		function getComStyle(property){
			if(obj.currentStyle) return obj.currentStyle[property.camelCase()];
			var computed = window.getComputedStyle(obj, null);
			return (computed) ? computed.getPropertyValue(property.hyphenate()) : null;
		}
		if(style == 'opacity'){
			if(window.ActiveXObject){
				result = getComStyle('filter').replace(/[^0-9\.]/g,'');
				result = result== '' ? 1 : parseInt(result*100)/10000;
				return result;
			}
			result = parseFloat(getComStyle(style));
			result = !result && result != 0 ? 1 : result; 
			
			return result;
		}
		style = style.camelCase();
		
		result = obj.style[style];

		if(!result&&result!==0){
			result = getComStyle(style);
		}
		if(result){
			//if(/rgb/.test(style)){
			//	resutl = result.rgbtoHex();
			//}
			if(/^(width)|(height)$/.test(style)){
				var path = style == 'width' ? ['left','right'] : ['top','bottom'],
					size =0;
				size = (parseInt(this.getStyle(obj,'padding-'+path[0])) || 0) + (parseInt(this.getStyle(obj,'padding-'+path[1])) || 0) + 
					   (parseInt(this.getStyle(obj,'border-'+path[0]+'-width')) || 0 ) + (parseInt(this.getStyle(obj,'border-'+path[1]+'-width')) || 0);
				result = obj['offset'+style.replace(/\b[a-z]/,function(m){return m.toUpperCase();})]-size;
				return result;
			}
			if(result == 'auto' && style == 'zIndex'){
				result = 0;
				return result;
			}
		}
		return result;
	},
	setStyle : function(obj,values){
		var str = ';';
		for(var key in values){
			if(values.hasOwnProperty(key)){
				if(key == 'opacity'){
					str += key + ':' + values[key] + ';filter:alpha(opacity='+ values[key]*100 +');';
					continue;
				}
				if(/(rgb)|(#)/i.test(values[key])){
					str += key +':'+ values[key] +  ';';
					continue;
				}
				str += key +':'+ Math.round(values[key])  + 'px;';
			}
		}
		obj.style.cssText += str;
		str = null;
		return ;
	},
	getPosition:function(obj){
		var o = typeof obj === 'string' ? document.getElementById(obj) : obj,
			x=0,
			y=0;
		while(o){
			x+=o.offsetLeft;
			y+=o.offsetTop;
			o = o.offsetParent;
		}
		return {x:x,y:y}
	},
	getChild:function(obj,node){
		var o = typeof obj === 'string' ? document.getElementById(obj) : obj,
			list = o.childNodes,
			nodes = [];
		for(var i=0,l=list.length;i<l;i++){
			if(node){
				if(list[i].nodeName == node.toUpperCase()){
					nodes.push(list[i]);
				}
			}else{
				if(list[i].nodeType == 1) nodes.push(list[i])
			}
		}
		o=null;list=null;
		return nodes;
	}
}


/*
 * Event
 */
var Event = {
	add : (function(){
		if(document.addEventListener){
			return function(obj,type,fn){ obj.addEventListener(type,fn,false)}
		}
		return function(obj,type,fn){ obj.attachEvent('on'+type,fn)}
	})(),
	remove : (function(){
		if(document.removeEventListener){
			return function(obj,type,fn){ obj.removeEventListener(type,fn,false)}
		}
		return  function(obj,type,fn){ obj.detachEvent('on'+type,fn)}
	})(),
	stop:function(e){
		if(e&&e.stopPropagation){
			e.stopPropagation();
			e.preventDefault();
		}else{
			window.event.cancelBubble = true;
			window.event.returnValue = false;
		}
	}
}


/*
 * Cookie
 */
var Cookie={
	read:function(name){
		var value = document.cookie.match('(?:^|;)\\s*' + name + '=([^;]*)');
		return (value) ? decodeURIComponent(value[1]) : null;
	},
	write:function(value){
		var str = value.name + '=' + encodeURIComponent(value.value);
			if(value.domain){ str += '; domain=' + value.domain;}
			if(value.path){ str += '; path=' + value.path;}
			if(value.day){
				var time = new Date();
				time.setTime(time.getTime()+value.day*24*60*60*1000);
				str += '; expires=' + time.toGMTString();
			}
		document.cookie = str;
		return;
	},
	dispose:function(name){
		var str = this.read(name);
		this.write({name:name,value:str,day:-1});
		return;
	}
}


/*
 * Anima
 */
function Anima(id,options){
	var opts,
		obj,
		step,
		timer,
		cancelFunc,
		transition,
		begin,
		current,
		end,
		style = {
			name : [],
			from : [],
			to : []
		},
		complete;
	
	function init(opt){
		opts = opt || {};
		obj = typeof id === 'string' ? document.getElementById(id) : id;
		step = parseInt((opts.time || 500));
		timer = null;
		cancelFunc = opts.cancel;
		transition = opts.trans || '1';
		begin = 0;
		current = 0;
		end = 0;
		style = {
			name : [],
			from : [],
			to : []
		};
		complete = opts.complete || null;
	}
	init(options);

	function start(opt){
		stop();
		style = {
			name : [],
			from : [],
			to : []
		};
		for(var key in opt){
			style.name.push(key.hyphenate());
			if(typeof opt[key] === 'object'){
				style.from.push(parseFloat(opt[key][0]));
				style.to.push(parseFloat(opt[key][1]));
				continue;
			}
			var result = Element.getStyle(obj,key);
			result = typeof result === 'undefind' ?  opt[key] : result;
			style.from.push(result);
			style.to.push(opt[key]);
			result = null;
		}
		begin = getTime();
		current = getTime();
		end = begin + step;
		play();
	}

	function play(){
		var m = 0;
		function move(){
			current = getTime();
			m = (current - begin)/step;
			if(m>=1){
				m=1;
			}
			var str = {},
				n='';
			for(var i=0,l=style.name.length;i<l;i++){
				if(/(rgb)|(#)/i.test(style.from[i])){
					var froms = setColor(style.from[i]),
						tos = setColor(style.to[i]),
						results = [];
					for(var j=0,k=froms.length;j<k;j++){
						results.push( Math.round(trans((froms[j]-0),(tos[j]-0),m)))
					}
					n =  results.join(',').rgbtoHex();
				}else{
					n = parseFloat(trans( parseFloat(style.from[i]),parseFloat(style.to[i]),m));
				}
				str[style.name[i]] = n;
			}
			Element.setStyle(obj,str);
			
			if(m==1){
				stop();
				onComplete();
				return;
			}
		}
		timer = setInterval(move,15);
		function trans(f,t,a){
			return f + (t-f)*transFunc(a);
		}
		
		function setColor(value){
			var result;
			if(value.indexOf('#')>-1){ 
				value = value.replace(/#/,'');
				if(value.length==3){
					value = value.replace(/(\w)(\w)(\w)/,'$1$1$2$2$3$3');
				}
				result = value.replace(/\w{2}/g,function(m){return parseInt(m.replace(/^0{1}/g,''),16)+','}).replace(/\,$/g,'').split(',');
				return result;
			}
			if(value.indexOf('rgb')>-1){
				result = value.match(/\d{1,3}/g);
			}
			return result;
		}
	}
	


	function trans(s){
		switch(s){
			case '0':
				transFunc = function(m){return m};
				break;
			case '2':
				transFunc = function(m){return Math.pow(m, 2) * (2.618 * m - 1.618)};
				break;
			case '3' : 
				transFunc = function(m){
					return (m<=0.5) ? Math.pow(m, 2) * (2.618 * m - 1.618) : (1 - Math.pow((1-m),2)*(2.618 * (1-m) - 1.618));
				}
				break;
			case '1' :
			default : 
				transFunc = function (m){ return (1-Math.cos(Math.PI*m))/2 };
		}
	}
	trans(transition);

	function pause(){
		stop();
	}

	function reStart(){
		var fix = current - begin;
		current = getTime();
		begin = current - fix;
		end = begin + step;
		play();
	}
	function stop(){
		if(timer){
			clearInterval(timer);
			timer = null;
		}
	}
	function getTime(){
		return (new Date()).getTime();
	}
	function cancel(){
		stop();
		if(cancelFunc) cancelFunc();
	}
	function onComplete(){
		if(complete) complete();
	}
	function setComplete(fn){
		if(fn) complete = fn;
	}

	return {
		start : start,
		cancel : cancel,
		pause : pause,
		reStart : reStart,
		complete : setComplete
	}

}
