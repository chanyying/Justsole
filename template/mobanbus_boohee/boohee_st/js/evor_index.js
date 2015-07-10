/*
 *  author tiger
 */

(function(){
	function $(id,tag){
		var re=(id&&typeof id!="string") ? id : document.getElementById(id);
		if(!tag){
			return re;
		}else{
			return re.getElementsByTagName(tag);
		}
	}

	function upper(m){
		return m.replace(/^[a-z]/g,function(n){ return n.charAt(0).toUpperCase()});
	}

	function tagSwitch(tit,box,s,fn,time,show){
		tit=tit.split('/');
		box=box.split("/");
		!s&&(s="mouseover");!show&&(show=0);
		var ts=$(tit[0]),
			bs=$(box[0]),
			n=0,
			tx=tit[2],
			bx=box[2],
			now=-1,i,c,
			old=-1;
		ts = Element.getChild(ts,tit[1]);
		bs = Element.getChild(bs,box[1]);
		n=ts.length;

		for(i=0;i<n;i++){reg(ts[i],bs[i],i);};
		function reg(tv,bv,i)
		{
			var timer = null;
			Element.removeClass(tv,'on');
			Element.removeClass(bv,'on');
			tv.old = tv.className || '';
			bv.old = bv.className || '';
			Event.add(tv,s,function(){
				if(timer) return;
				timer = setTimeout(function(){
					timer = null;
					clearInterval(c);
					init(i);	
				},50);
			});
			Event.add(tv,'mouseout',function(){
				if(timer){
					clearTimeout(timer);
					timer = null;
				}
			})
			if(show!=-1&&time){
				Event.add(bv,"mouseover",function(){clearInterval(c);});
				Event.add(bv,"mouseout",go);
				Event.add(tv,"mouseout",function(){
					if(timer){
						clearTimeout(timer);
						timer = null;
					}
					go();
				});
			}
			else if(show==-1&&s=="mouseover"){
				Event.add(tv,"mouseout",function(){init(0);});
			}
		}
		init(0);
		if(show!=-1&&time){c=setInterval(auto,time);}
		function go(){clearInterval(c);c=setInterval(auto,time);}
		function init(m){
			if(m==now) return;
			if(old>-1){
				Element.removeClass(ts[old],'old');
				Element.removeClass(bs[old],'old');
			}
			if(now>-1){
				Element.addClass(ts[now],'old');
				Element.addClass(bs[now],'old');
				Element.removeClass(ts[now],'on');
				Element.removeClass(bs[now],'on');
				old = now;
			}
			if(m>-1){
				Element.addClass(ts[m],'on');
				Element.addClass(bs[m],'on');
				now = m;
			}
			fn&&fn(ts[m],bs[m],m);
		}

		function auto(){
			var s = now;
			(s<n-1)?s++:s=0;
			init(s);
		};
	}


	function inputFocus(id,defaultValue){
		var obj = $(id),
			v = defaultValue;
		Event.add(obj,'focus',function(){
			if(obj.value == v){
				obj.value = '';
				Element.addClass(obj,'on');
			}
		})
		Event.add(obj,'blur',function(){
			if(obj.value == '' || obj.value == v){
				obj.value = v;
				Element.removeClass(obj,'on');
			}
		})
	}

	function loadScript(url,callback,charset){
		var script = document.createElement('script');
			script.setAttribute('async',true);
			script.src = url;
			if(charset) script.charset = charset;
			script.readyState ? script.onreadystatechange = function(){
				if(script.readyState == 'loaded' || script.readyState =='complete'){
					setTimeout(function(){
						if(callback) callback();
					},100)

				}
			}:
			script.onload = function(){
				if(callback) callback();
			}
			document.getElementsByTagName('head')[0].appendChild(script);
	}


	function lazyLoad(id,tarid,type){
		if(!id || !tarid) return;
		var obj = document.getElementById(id),
			tar = document.getElementById(tarid),
			n = 0,
			inner = '',
			div = document.createElement('div');
		if(!obj || !tar) return;
		if(type){
			obj.appendChild(tar);
			return;
		}
		/*n = tar.innerHTML.toLowerCase().indexOf('</script>') + 9;*/
		inner = tar.innerHTML.replace(/\<script[^\>]{1,}(yokaafp7\.allyes\.com|yoka\.adsame\.com)[^\>]{1,}\>\<\/script\>/g,'');
		inner = inner.replace(/\<div\s{1,}adCount.*\<\/div\>/,'');
		div.innerHTML = inner;
		obj.appendChild(div);
		tar.innerHTML = '';
		inner = null;
	}
	
	function menu(tit,con){
		tit=tit.split('/');
		con=con.split('/');
		var ts = $(tit[0],tit[1]),
			cs = $(con[0],con[1]),
			box = $(con[0]),
			str = [];
		for(var i=0;i<ts.length;i++){
			str.push(ts[i].parentNode.parentNode);
		};
		for(var i=0;i<ts.length;i++){
			obj(i);
		};
		function obj(n){
			Event.add(str[n],"mouseover",function(){
				show(n);
			});
			Event.add(cs[n],"mouseover",function(){
				show(n);
			});
			Event.add(str[n],"mouseout",function(){
				hidden(n);
			});
			Event.add(cs[n],"mouseout",function(){
				hidden(n);
			});
		};
		
		function show(n){
			var p = Element.getPosition(str[n]);
			box.style.cssText = "display:block;top:" + (p.y+str[n].offsetHeight) +"px;left:" + (p.x-30) +"px";
			cs[n].style.display ="block";
		};
		
		function hidden(n){
			box.style.cssText = "";
			cs[n].style.display ="";
		};
	}
	
	function autoWidthMove(data){
        var obj = $(data.id), 
			ctrl = $(data.ctrl), 
			left = $(data.left), 
			right = $(data.right),
			staus = false,
			span,
			cun,
			cur = 0,
			to,
			fn = null,
			time = data.time,
			anima = Anima(obj);
        
        obj.innerHTML += obj.innerHTML;
        
        var tag = Element.getChild(obj, data.tag), 
        	len = tag.length/2, 
        	movsize = -tag[0].offsetWidth, 
        	maxwidth = len * movsize;
        
		
		function init(){
			var str = "";
			for(var i=0;i<len; i++){
				str += i == cur ? '<li class = "on"></li>':'<li></li>';
			};			
			ctrl.innerHTML = str;
			span = $(ctrl, 'li');						
			for(var i=0;i<len;i++) {
				ctrlArea(i);
			};
			auto();
		};
		
		function ctrlArea(num){
			Event.add(span[num], 'click', function() {
				clear();
				to = num * movsize;
				move();
				setnum(num);
			})
		};        
        
        function setnum(c){
            if (cur == c) return;
            (c > len - 1) && (c = 0);
            (c < 0) && (c = len - 1);
			Element.addClass(span[c],"on");
			Element.removeClass(span[cur],"on");
            cur = c;
        };

        function add(w){
			if(staus) return;
			staus = true;
            cun = cur;
			if(w){
				cun--;
				if(cun<0){
					cun = len-1;
					obj.style.marginLeft = maxwidth + "px";
				}
			}else{
				cun++;
				if(cun==1){
					obj.style.marginLeft = 0;
				}
			}		
            to = cun * movsize;
            move();
            setnum(cun);
        };
        
        function move(){
            anima.start({
                marginLeft: to
            });
            
            anima.complete(function(){
				staus = false;
                auto();
            });
        };
		
		function clear(){clearTimeout(fn);fn = null};
        function auto(){clear(); if(time) fn = setTimeout(function(){add(false)}, time)};        
        
        Event.add(left, "click", function(){
			add(true);
		})
        Event.add(right, "click", function(){
            add(false);
        })
        Event.add(left, "mouseover", function(){
            left.style.cssText = "opacity:1;filter:alpha(opacity=100)";
        });
        Event.add(right, "mouseover", function(){
            right.style.cssText = "opacity:1;filter:alpha(opacity=100)";
        });
		Event.add(left, "mouseout", function(){
            left.style.cssText = "";
        });
        Event.add(right, "mouseout", function(){
            right.style.cssText = "";
        });
		Event.add(obj, "mouseover", clear);
		Event.add(obj, "mouseout", auto);
        
		
		init();
    }
	
	function hovershow(id){
		var ycId = $(id,"dd");
		for(var i=0; i<ycId.length; i++){
			obj(i)
		};		
		function obj(n){
			Event.add(ycId[n].parentNode,"mouseover",function(){
				ycId[n].style.display = "block";
			});
			Event.add(ycId[n].parentNode,"mouseout",function(){
				ycId[n].style.display = "none";
			})
		}		
	};
	
	function setbtn(id,style){
		var o = $(id);
		Event.add(o,"mouseover",function(){
			Element.addClass(o,style);
		});
		Event.add(o,"mouseout",function(){
			Element.removeClass(o,style);
		});		
	}
	
	function setinput(id,style){
		var o = $(id);
		Event.add(o,"focus",function(){
			Element.addClass(o.parentNode,style);
		});
		Event.add(o,"blur",function(){
			Element.removeClass(o.parentNode,style);
		});		
	}
	
	
	function sun(id){
		function addEvent(o,sty,fun){o.attachEvent?o.attachEvent("on"+sty,fun):o.addEventListener(sty,fun,false);};
		var timer=null,objDt=$(id),span=$(objDt,"span")[0];
		addEvent(objDt,"mouseover",show);
		addEvent(objDt,"mouseout",hide);
		function show(){clearTimer();span.className="on";}
		function hide(){clearTimer();timer=setTimeout(function(){span.className="";},50);}
		function clearTimer(){timer&&clearTimeout(timer);timer=null;}
	}
	
	window['yo'] = {
		'tagSwitch' : tagSwitch,
		'inputFocus' : inputFocus,
		'loadScript' : loadScript,
		'lazyLoad' : lazyLoad,
		'menu':menu,
		'autoWidthMove':autoWidthMove,
		'hovershow' : hovershow,
		'setbtn' : setbtn,
		'setinput' : setinput,
		'sun' : sun
	}
	
})();

(function(){
	function dom(name,tag,style){
		name = document.createElement(tag);
		name.className = style;
		document.body.insertBefore(name, document.body.childNodes[0]);
		return name;
	};
	
	function position(o) {
		var x = 0 , y = o.offsetHeight;
		while (o) {
			x += o.offsetLeft;	
			y += o.offsetTop;
			o = o.offsetParent
		}
		return {
			x : x,
			y : y
		}
	};	
	
	window.srh = function(json){
		this.obj = document.getElementById(json["id"]);
		this.focusstaus;
		this.value = json["value"];
		this.tip = dom(this.tip,"ul",json["style"]);
		this.call = json["call"];
		this.json = json;
		this.cur = -1;
		this.tags = null;
		this.showstaus = false;
		this.data;		
		this.init();	
	};
	
	srh.prototype.init = function(){		
		var _this = this;		
		if(this.obj.value == "" || this.obj.value == this.value){
			this.obj.value = this.value;
		}else{
			this.obj.className = "onfocus";
		};		
		Event.add(this.obj,'focus',function(){
			_this.onfocus();
		});
		Event.add(this.obj,'blur',function(){
			_this.onblur();
		});
		Event.add(document,'keyup',function(e){
			_this.onkeyup(e);
		});
		Event.add(document,'keydown',function(e){
			_this.onkeydown(e);
		});
	};
	
	
	srh.prototype.onfocus = function(){
		if(this.obj.value == "" || this.obj.value == this.value){
			this.obj.value = "";
			this.obj.className = "onfocus";				
		};
		this.focusstaus = true;
	};
	
	srh.prototype.onblur = function(){
		if(this.obj.value=="" || this.obj.value == this.value){
			this.obj.value = this.value;
			this.obj.className = "";				
		}
		this.tiphidden();
		this.focusstaus = false;
	};
	
	srh.prototype.onkeyup = function(e){
		if(!this.focusstaus) return;		
		e = e || window.event;
		if((e.keyCode < 112 && e.keyCode > 45) || e.keyCode == 8 || e.keyCode == 32){
			var now = this.obj.value;
			if(now == "" || now == null || now == this.value){
				this.tip.innerHTML = "";
				this.tiphidden();
			}else{
				this.json["post"](now);
			}
		}
	};
	
	srh.prototype.onkeydown = function(e){
		if(!this.focusstaus || this.tags==null || this.tags.length<=0) return;
		e = e || window.event;		
		if(e.keyCode==40) this.move(this.cur+1,true);
		if(e.keyCode==38) this.move(this.cur-1,true);
		if(e.keyCode==13){
			if(this.cur>-1) this.obj.value = this.tags[this.cur].title;
			this.call(this.data[this.cur]);
			this.tiphidden();
		};
		if(e.keyCode==9 || e.keyCode==27){
			this.tiphidden();
		}
	};
	
	srh.prototype.move = function(n,s){
		if(n==this.tags.length) n = 0;
		if(n<0) n = this.tags.length - 1;
		if(this.cur==-1) this.cur = 0;
		if(s) this.obj.value = this.tags[n].title;		
		this.tags[this.cur].className = "";
		this.tags[n].className = "hover";
		this.current(n);
		this.tip.style.display = "block";
	};
	
	srh.prototype.get = function(data){
		var value = this.obj.value, pos = position(this.obj), str = '', c = 0;	
		this.data = data;
		for(var i=0;i<data.length; i++){
			if((data[i]["name"]+data[i]["name_en"]).toLowerCase().indexOf(value.toLowerCase()) != '-1'){
				c++;
				str += rep(i);
				if(c == this.json["number"]) break ;
			}
		};

		function rep(n){
			var keyword = data[n]["name"] + data[n]["name_en"];			
			return '<li title="' + keyword +'" value="' + n + '">' + keyword.toLowerCase().replace(value.toLowerCase(),("<b>" + value + '</b>')) + '</li>';
		};
		
		this.tip.innerHTML = str;
		this.tip.style.cssText = "display:block;top:" + pos.y + "px;left:" + pos.x + "px";
		this.Event();
	};
	
	srh.prototype.Event = function(){
		var _this = this, tags = this.tip.getElementsByTagName("li");
		this.tags = tags;
			
		for(var i=0;i<tags.length;i++){
			reg(i);
		};
		
		function reg(n){
			var tag = tags[n];
			Event.add(tag,"mouseover",function(){
				_this.move(n);
				_this.show(true);
			})
			Event.add(tag,"mouseout",function(){
				tag.className = "";
				_this.show(false);
			})
			Event.add(tag,"click",function(){
				if(_this.call){
					_this.call(_this.data[n]);
				}
				_this.obj.value = tag.title;
				_this.show(false);
				_this.tiphidden();
			})
		};		
		this.current(-1);
	};
	
	srh.prototype.current = function(n){
		this.cur = n;
	}
	
	srh.prototype.show = function(v){
		this.showstaus = v;
	}
	
	srh.prototype.tiphidden = function(){
		if(this.showstaus) return;
		this.tip.style.display = "none";
		if(this.cur>-1) this.tags[this.cur].className = "";
		this.current(-1);
	};	
})()



/**
 * @author {tiger}
 */
function lazyload(){
	function each(ar,fn){
		for(var i=0,l=ar.length;i<l;i++){
			fn.call(ar[i],i);
		}
	}
	var addEvent = (function(){ 
		return document.attachEvent ? 
			function(obj,type,fn){ 
				obj.attachEvent('on'+type,fn)
			} : 
			function(obj,type,fn){ 
				obj.addEventListener(type,fn,false)
			}
		})()
	var removeEvent = (function(){ 
			return document.attachEvent ? 
				function(obj,type,fn){ 
					obj.detachEvent('on'+type,fn)
				} : 
				function(obj,type,fn){ 
					obj.removeEventListener(type,fn,false)
				}
		})()
	
	var imgs = document.getElementsByTagName('img'),
		body = document.getElementsByTagName('body')[0],
		sHeight = document.documentElement.clientHeight || document.body.clientHeight,
		sWidth = document.documentElement.clientWidth || document.body.clientWidth,
		overflow = [ sWidth , sHeight ] ,
		range ={
			x:[0,overflow[0]],
			y:[0,overflow[1]]
		};
	
	function filter(){
		if(imgs.length ==0){
			removeEvent(window,'scroll',filter);
			return;
		}
		var _ar = [],
			site = {
				x:document.body.scrollLeft || document.documentElement.scrollLeft,
				y:document.body.scrollTop || document.documentElement.scrollTop
			},
			range = {
				x:[site.x-overflow[0]/2 , site.x+overflow[0]],
				y:[site.y-overflow[1]/2 , site.y+overflow[1]]
			},
			temp = null;
		each(imgs,function(){
			temp = getSite(this);
			//if(temp.x>=range.x[0] && temp.x <= range.x[1] && temp.y >= range.y[0] && temp.y <= range.y[1]){
			if(temp.y >= range.y[0] && temp.y <= range.y[1]){
				this.src = this.getAttribute('_src');
				//this.removeAttribute('_src');
			}else{
				_ar.push(this);
			}
		})
		imgs = [].concat(_ar);
		_ar = null;
		return imgs;
	}
	
	function getSite(obj){
		var s={x:0,y:0};
			while(obj){
				s.x+=obj.offsetLeft;
				s.y+=obj.offsetTop;
				obj=obj.offsetParent;
			}
		return s;
	}
	
	function init(){
		var ar = [];
		each(imgs,function(){
			if(this.getAttribute('_src')){
				ar.push(this)
			}
		})
		imgs = [].concat(ar);
		ar = null;
		filter();
	}
	
	init();
	
	addEvent(window,'scroll',filter);
	addEvent(window,'resize',function(){
		sHeight = document.documentElement.clientHeight || document.body.clientHeight;
		sWidth = document.documentElement.clientWidth || document.body.clientWidth;
		overflow = [ sWidth , sHeight ];
		filter();
	})

}

