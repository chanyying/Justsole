var Class={create:function(){return function(){this.initialize.apply(this,arguments);}}}
var Zooms=Class.create();
Zooms.prototype=
{
	bindFun:function(o,fun){return function(){return fun.apply(o,arguments);}},
	addEvent:function(o,s,fun){o.attachEvent?o.attachEvent("on"+s,fun):o.addEventListener(s,fun,false);return o;},
	initialize:function(n)
	{
		this.width=	n.width;
		this.height=n.height;
		this.api=	n.api,							//  *句柄
		this.id=	document.getElementById(n.id);	//  *容器ID
		this.path=	n.path;							//  *图片或FLASH地址
		this.url = n.url;							//  链接地址
		this.full=	n.full;				            //  是否全屏
		this.closetime=n.closetime || 10000;			//  关闭时间
		this.noWait = n.noWait || false;            //  不等待flash加载完成，就开始显示
		this.o=this.id.getElementsByTagName("dt")[0];//  放置内容的容器;
		this.c = document.getElementById(n.closeObj);//  关闭按钮 
		this.addEvent(this.c,"click",this.bindFun(this,this.Close));
		this.max=this.height;
		this.v=0;
		this.go=null;
		this.cols=null;
		this.wmode= n.wmode || 'transparent';
		this.id.style.height="1px";
		this.bgcolor = n.bgcolor || 'none';
		
		if(this.full)
		{
			this.nh = window.innerWidth?window.innerHeight:document.documentElement.clientHeight; //文档可视区域高度
			this.nw = window.innerWidth?window.innerWidth:document.documentElement.clientWidth;   //文档可视区域宽度
			if( !(navigator.userAgent.indexOf('MSIE 6.0')>0 || navigator.userAgent.indexOf('MSIE 7.0')>0) ){
				this.nw -= 17;
			}
			this.height=n.height>this.nh?this.nh:n.height;
			this.width=n.height>this.nh?this.height*n.width/n.height:n.width;
		}
	},
	start:function()
	{ 
		if(this.noWait){
			if(this.full){
				this.id.style.cssText='background:' + this.bgcolor + ";display:block;z-index:98888;left:0px;top:0;width:"+this.nw+"px;height:2000px;position:fixed;_position:absolute;overflow:hidden;";
				this.c.style.right=(this.nw-this.width)/2 +'px';
				this.c.style.top=((this.nh-this.height)/2+this.height-17)+'px';
				this.set();
			}else{
				this.Open();
			}
		}else{
			this.set();
		}
	},
	set:function(){
			this.o.innerHTML="<object id='"+this.api+"swf' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,24,0' width='1' height='1'><param name='movie' value='http://images.yoka.com/pic/div/yokajs/HomepageADnew.swf'><param name='wmode' value='transparent'><param name='allowScriptAccess' value='always'><param name='allowFullScreen' value='false' /><param name='quality' value='high'><param name='menu' value='false'><param name='FlashVars' value='path="+this.path+"&api="+this.api+"'><embed FlashVars='path="+this.path+"&api="+this.api+"' width='1' height='1' src='http://images.yoka.com/pic/div/yokajs/HomepageADnew.swf' name='"+this.api+"swf' allowScriptAccess='always' allowFullScreen='false' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' wmode='transparent' type='application/x-shockwave-flash'></embed></object>";					
	},
	Open:function()
	{
		
		clearInterval(this.cols);this.cols=setTimeout(this.bindFun(this,this.Close),this.closetime);//延时关闭
		if (this.full){this.fullScreenOpen();}
		else{this.max=this.height;this.StartOpen();this.reNew();}
	},
	setInner : function(){
		var str = "<object  id='"+this.api+"vf' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,24,0' width='"+this.width+"' height='"+this.height+"'><param name='movie' value='"+this.path+"'><param name='wmode' value='"+this.wmode+"'><param name='allowScriptAccess' value='always'><param name='allowFullScreen' value='false'><param name='quality' value='high'><param name='menu' value='false'><embed width='"+this.width+"' height='"+this.height+"' src='"+this.path+"' name='"+this.api+"vf' allowScriptAccess='always' allowFullScreen='false' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' wmode='"+this.wmode+"' type='application/x-shockwave-flash'></embed></object>";
		if(this.url && this.url != '') {str+= "<a href='"+ this.url +"' target='_blank'><img src=\"http://p1.yokacdn.com/pic/div/public/img/space.gif\" style=\"width:"+ this.width +"px;height:"+ this.height +"px;position:absolute;top:0;left:0;\" /></a>";}
		this.o.innerHTML = str;
	},
	reNew:function()
	{
		clearInterval(this.go);
		this.go=setInterval(this.bindFun(this,Goto),20);
		function Goto()
		{
			this.v=this.max>this.id.offsetHeight?Math.ceil((this.max-this.id.offsetHeight)/4):Math.floor((this.max-this.id.offsetHeight)/4);
			this.id.style.height=(this.id.offsetHeight+this.v)+"px";
			if(this.v==0)
			{
				clearInterval(this.go);
				if(this.max!=1){this.o.style.height=this.height+"px";this.o.style.width=this.id.style.width=this.width+"px";this.c.style.right='0px';this.c.style.bottom='0px'; this.setInner(); this.EndOpen();}
				else{
					this.o.style.height='1px';this.id.style.height="0";this.o.style.width=this.id.style.width="1px";this.EndClose();
				}
			}
		}
	},
	fullScreenOpen:function()
	{	
		this.id.style.cssText='background:' + this.bgcolor + ";display:block;z-index:98888;left:0px;top:0;width:"+this.nw+"px;height:2000px;position:fixed;_position:absolute;overflow:hidden;";
		this.o.style.cssText="height:"+this.nh+"px;width:"+this.width+"px;display:block;margin:0 auto;padding-top:"+((this.nh-this.height)/2)+"px";
		this.c.style.right=(this.nw-this.width)/2 +'px';
		this.c.style.top=((this.nh-this.height)/2+this.height-17)+'px';
		if(navigator.appName=='Microsoft Internet Explorer' && navigator.appVersion.indexOf('6.0')>0)
		{this.id.style.position="absolute";this.addEvent(window,'scroll',this.bindFun(this.id,function(){this.style.top=document.documentElement.scrollTop +'px';}))}
		this.setInner();
	},
	Close:function()
	{
		clearInterval(this.cols);this.o.innerHTML='';
		if(this.full){this.id.style.cssText="position:absolute;left:0px;top:0px;width:0px;height:0px;overflow:hidden;display:none;";this.EndClose();}
		else{this.max=1;this.StartClose();this.reNew();}
	},
	StartOpen:function(){},
	StartClose:function(){},
	EndOpen:function(){},
	EndClose:function(){}
}