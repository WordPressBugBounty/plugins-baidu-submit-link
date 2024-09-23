(function(e){var h=function(u){return'https://s.360.cn/so/zz.gif?url='+encodeURIComponent(u)+'&sid='+qhcode+'&token='+c(u);}
    var c=function(u){var l=u.length;var n=[];var s='';var u=u.split('').reverse().join('');var m=qhcode.split('').reverse().join('')
        for(var i=0;i<16;i++){s=i<l?m[i]+u[i]:m[i];n.push(s)}
        return n.join('');}
        var l =  e.location.href;
    if(!l || !window.navigator.appName){
        return;
    }
        if(!qhbatch){
            var t=new Image;t.src=h(l);
        return;
    }
    var a=document.getElementsByTagName('a');
    var u,k,d=document.location.href.replace(/https?:\/\//,'').split('/')[0];
    var g=[];for(var i=0;i<a.length;i++){u=a[i].href;k=a[i].rel;u=u.replace(/\#.+/g,'');if(u.indexOf(d)<0){continue;}
        if(u.indexOf('/wp-admin/')>-1){continue;}
        if(u.indexOf('/wp-login\.php')>-1){continue;}
        if(/nofollow/.test(k)){continue;}
        if(g.indexOf(u)>-1){continue;}
        g.push(u);var t=new Image;t.src=h(u);}})(window);