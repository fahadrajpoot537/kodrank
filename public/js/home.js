(function(){
  var reduce=false;
  try{ reduce=window.matchMedia('(prefers-reduced-motion: reduce)').matches; }catch(e){}

  // --- reveal on scroll (content already visible if this never runs) ---
  var revealAll=function(){ var n=document.querySelectorAll('.rv'); for(var i=0;i<n.length;i++){ n[i].classList.add('on'); } };
  try{
    if('IntersectionObserver' in window && !reduce){
      var io=new IntersectionObserver(function(entries){
        entries.forEach(function(e){ if(e.isIntersecting){ e.target.classList.add('on'); io.unobserve(e.target); } });
      },{threshold:.12,rootMargin:'0px 0px -6% 0px'});
      var els=document.querySelectorAll('.rv');
      for(var i=0;i<els.length;i++){ els[i].style.transitionDelay=(i%3)*70+'ms'; io.observe(els[i]); }
      setTimeout(revealAll,3500); // hard safety net
    } else { revealAll(); }
  }catch(err){ revealAll(); }

  // --- sticky nav ---
  var nav=document.getElementById('nav');
  if(nav){
    var alwaysStuck = nav.getAttribute('data-always-stuck') === '1';
    var onScroll=function(){
      nav.classList.toggle('stuck', alwaysStuck || window.scrollY>40);
    };
    onScroll(); window.addEventListener('scroll',onScroll,{passive:true});
  }

  // --- hero video: play from <source> files (webm/mp4), muted autoplay ---
  var v=document.getElementById('heroVideo');
  if(v && !reduce){
    v.muted=true; v.defaultMuted=true; v.setAttribute('muted','');
    var go=function(){ try{ var pr=v.play(); if(pr&&pr.catch){ pr.catch(function(){}); } }catch(e){} };
    if(v.readyState>=2){ go(); }
    v.addEventListener('loadeddata',go,{once:true});
    v.addEventListener('canplay',go,{once:true});
    try{ v.load(); }catch(e){}
    var kick=function(){ if(v.paused){ go(); } document.removeEventListener('pointerdown',kick); document.removeEventListener('touchstart',kick); };
    document.addEventListener('pointerdown',kick,{passive:true});
    document.addEventListener('touchstart',kick,{passive:true});
  } else if(v){ v.removeAttribute('autoplay'); }

  // --- mega menu (hover on desktop, accordion click on mobile) ---
  var megaRoot=document.querySelector('.has-mega');
  var megaTrigger=document.querySelector('.nav-mega-trigger');
  var mega=document.querySelector('.mega');
  if(megaRoot&&megaTrigger&&mega){
    var megaCloseTimer=null;
    var canHover=false;
    try{ canHover=window.matchMedia('(hover:hover) and (pointer:fine)').matches; }catch(e){}

    var isMobileNav=function(){
      return (window.innerWidth||document.documentElement.clientWidth||0)<=900;
    };

    var openMega=function(){
      if(megaCloseTimer){ clearTimeout(megaCloseTimer); megaCloseTimer=null; }
      mega.classList.add('open');
      megaRoot.classList.add('is-open');
      megaTrigger.setAttribute('aria-expanded','true');
    };
    var closeMega=function(){
      if(megaCloseTimer){ clearTimeout(megaCloseTimer); megaCloseTimer=null; }
      mega.classList.remove('open');
      megaRoot.classList.remove('is-open');
      megaTrigger.setAttribute('aria-expanded','false');
    };
    var scheduleCloseMega=function(){
      if(isMobileNav()) return; // never auto-close accordion on mobile
      if(megaCloseTimer) clearTimeout(megaCloseTimer);
      megaCloseTimer=setTimeout(function(){
        closeMega();
        megaCloseTimer=null;
      },180);
    };

    if(canHover){
      megaRoot.addEventListener('mouseenter',function(){
        if(!isMobileNav()) openMega();
      });
      megaRoot.addEventListener('mouseleave',scheduleCloseMega);
      mega.addEventListener('mouseenter',function(){
        if(!isMobileNav()) openMega();
      });
      mega.addEventListener('mouseleave',scheduleCloseMega);
    }

    megaTrigger.addEventListener('click',function(e){
      e.preventDefault();
      e.stopPropagation();
      if(megaCloseTimer){ clearTimeout(megaCloseTimer); megaCloseTimer=null; }
      if(mega.classList.contains('open')) closeMega();
      else openMega();
    });

    document.addEventListener('click',function(e){
      if(e.target.closest('.has-mega')) return;
      closeMega();
    });
  }

  // --- industries mega (hover CSS on desktop; click accordion on mobile) ---
  (function(){
    var roots=document.querySelectorAll('.has-industries-mega');
    if(!roots.length) return;
    var isMobileNav=function(){
      return (window.innerWidth||document.documentElement.clientWidth||0)<=900;
    };
    roots.forEach(function(root){
      var trigger=root.querySelector('.nav-mega-trigger');
      if(!trigger) return;
      trigger.addEventListener('click',function(e){
        e.preventDefault();
        e.stopPropagation();
        if(!isMobileNav()) return; // desktop uses CSS :hover
        var open=root.classList.toggle('open');
        trigger.setAttribute('aria-expanded', String(open));
      });
    });
    document.addEventListener('click',function(e){
      if(e.target.closest('.has-industries-mega')) return;
      roots.forEach(function(root){
        root.classList.remove('open');
        var t=root.querySelector('.nav-mega-trigger');
        if(t) t.setAttribute('aria-expanded','false');
      });
    });
    document.addEventListener('keydown',function(e){
      if(e.key!=='Escape') return;
      roots.forEach(function(root){
        root.classList.remove('open');
        var t=root.querySelector('.nav-mega-trigger');
        if(t) t.setAttribute('aria-expanded','false');
      });
    });
  })();

  // --- mobile burger: toggle .nav-links.is-open (CSS panel in home-extra.css) ---
  var burger=document.querySelector('.nav-burger');
  var links=document.querySelector('.nav-links');
  if(burger&&links){
    burger.addEventListener('click',function(e){
      e.stopPropagation();
      var open=links.classList.toggle('is-open');
      burger.setAttribute('aria-expanded', String(open));
      if(nav) nav.classList.add('stuck');
      if(!open && mega){
        mega.classList.remove('open');
        if(megaRoot) megaRoot.classList.remove('is-open');
        if(megaTrigger) megaTrigger.setAttribute('aria-expanded','false');
      }
    });
    var as=links.querySelectorAll('a');
    for(var j=0;j<as.length;j++){
      as[j].addEventListener('click',function(){
        if(window.innerWidth<=900){
          links.classList.remove('is-open');
          burger.setAttribute('aria-expanded','false');
          if(mega){ mega.classList.remove('open'); }
          if(megaRoot){ megaRoot.classList.remove('is-open'); }
          if(megaTrigger){ megaTrigger.setAttribute('aria-expanded','false'); }
        }
      });
    }
  }
  // --- homepage carousels (services + industries): scroll-snap on mobile, transform grid on desktop ---
  (function(){
    var MOBILE_MAX=900;
    var reduce=false;
    try{ reduce=window.matchMedia('(prefers-reduced-motion: reduce)').matches; }catch(e){}

    function isMobile(){
      return (window.innerWidth||document.documentElement.clientWidth||0)<=MOBILE_MAX;
    }

    function initHomeCarousel(root, opts){
      if(!root||root.dataset.homeCarouselReady==='1') return;
      if(root.classList.contains('page-svc-carousel')||root.classList.contains('page-svc-stack')||root.hasAttribute('data-sp-carousel')||root.hasAttribute('data-sp-stack')) return;

      var viewport=root.querySelector(opts.viewportSel);
      var track=root.querySelector(opts.trackSel);
      var slides=Array.prototype.slice.call(root.querySelectorAll(opts.slideSel));
      var prev=root.querySelector(opts.prevSel);
      var next=root.querySelector(opts.nextSel);
      var dotsWrap=root.querySelector(opts.dotsSel);
      var foot=root.querySelector('.home-carousel-foot');
      if(!viewport||!track||!slides.length) return;

      root.dataset.homeCarouselReady='1';

      var desktopPer=parseInt(root.getAttribute('data-per-desktop')||String(opts.desktopPer||3),10)||3;
      var AUTO_MS=opts.autoMs||4000;
      var dotClass=opts.dotClass||'svc-dot';
      var isQuotes=root.classList.contains('quotes-carousel');
      var index=0, per=desktopPer, slideW=0, gap=20;
      var startX=0, deltaX=0, dragging=false, didSwipe=false, autoTimer=null, resumeTimer=null;

      var getPer=function(){
        if(isMobile()) return 1;
        var w=window.innerWidth||document.documentElement.clientWidth||0;
        if(w<=680) return 1;
        if(w<=MOBILE_MAX) return Math.min(2, desktopPer);
        return desktopPer;
      };

      var maxIndex=function(){ return Math.max(0, slides.length-per); };

      var equalizeQuoteHeights=function(){
        if(!isQuotes||isMobile()) return;
        for(var s=0;s<slides.length;s++){
          slides[s].style.removeProperty('min-height');
          slides[s].style.removeProperty('height');
        }
        var maxH=0;
        for(var h=0;h<slides.length;h++){
          maxH=Math.max(maxH, slides[h].offsetHeight);
        }
        if(maxH<1) return;
        for(var s=0;s<slides.length;s++){
          slides[s].style.minHeight=maxH+'px';
          slides[s].style.height=maxH+'px';
        }
      };

      var clearSlideStyles=function(){
        for(var s=0;s<slides.length;s++){
          slides[s].style.removeProperty('flex');
          slides[s].style.removeProperty('width');
          slides[s].style.removeProperty('min-width');
          slides[s].style.removeProperty('max-width');
          slides[s].style.removeProperty('min-height');
          slides[s].style.removeProperty('height');
          slides[s].style.removeProperty('box-sizing');
        }
        track.style.removeProperty('width');
        track.style.removeProperty('transform');
        track.style.removeProperty('transition');
      };

      var cardLeft=function(card){
        var sRect=track.getBoundingClientRect();
        var cRect=card.getBoundingClientRect();
        return cRect.left-sRect.left+track.scrollLeft;
      };

      var syncDots=function(){
        if(!dotsWrap) return;
        var dots=dotsWrap.querySelectorAll('.'+dotClass);
        var page=isMobile()?index:Math.floor(index/Math.max(per,1));
        for(var d=0;d<dots.length;d++) dots[d].classList.toggle('is-active', d===page);
      };

      var buildDots=function(){
        if(!dotsWrap) return;
        var pages=isMobile()?slides.length:Math.ceil(slides.length/Math.max(per,1));
        dotsWrap.innerHTML='';
        if(pages<=1){ dotsWrap.hidden=true; return; }
        dotsWrap.hidden=false;
        for(var i=0;i<pages;i++){
          var b=document.createElement('button');
          b.type='button';
          b.className=dotClass+(i===0?' is-active':'');
          b.setAttribute('aria-label','Go to slide '+(i+1));
          (function(target){
            b.addEventListener('click',function(e){
              e.preventDefault();
              e.stopPropagation();
              goTo(isMobile()?target:target*per);
              pauseThenResume();
            });
          })(i);
          dotsWrap.appendChild(b);
        }
      };

      var syncFoot=function(){
        var show=isMobile()&&slides.length>1;
        if(foot){
          foot.hidden=!show;
          foot.style.display=show?'':'none';
        }
        if(prev){
          prev.hidden=!show;
          prev.style.display=show?'':'none';
        }
        if(next){
          next.hidden=!show;
          next.style.display=show?'':'none';
        }
        if(dotsWrap && !show) dotsWrap.hidden=true;
      };

      var measureDesktop=function(){
        per=getPer();
        root.style.setProperty('--svc-per', String(per));
        root.style.setProperty('--ind-per', String(per));
        gap=parseFloat(window.getComputedStyle(track).gap);
        if(!gap && gap!==0) gap=20;
        var vw=viewport.getBoundingClientRect().width||viewport.clientWidth;
        if(vw<2) vw=Math.max(200,(root.getBoundingClientRect().width||root.clientWidth));
        slideW=Math.max(1,(vw-(per-1)*gap)/per);
        for(var s=0;s<slides.length;s++){
          slides[s].style.boxSizing='border-box';
          slides[s].style.flex='0 0 '+slideW+'px';
          slides[s].style.width=slideW+'px';
          slides[s].style.minWidth=slideW+'px';
          slides[s].style.maxWidth=slideW+'px';
        }
        for(var s=0;s<slides.length;s++){
          slides[s].style.removeProperty('min-height');
          slides[s].style.removeProperty('height');
        }
        track.style.width=(slideW*slides.length+gap*Math.max(0,slides.length-1))+'px';
        equalizeQuoteHeights();
      };

      var stopAuto=function(){
        if(autoTimer){ clearInterval(autoTimer); autoTimer=null; }
        if(resumeTimer){ clearTimeout(resumeTimer); resumeTimer=null; }
      };

      var startAuto=function(){
        stopAuto();
        if(reduce||slides.length<=1) return;
        if(isMobile()){
          autoTimer=setInterval(function(){
            if(dragging) return;
            var n=index+1;
            goTo(n>=slides.length?0:n, true);
          }, AUTO_MS);
        }else if(maxIndex()>0){
          autoTimer=setInterval(function(){
            if(dragging) return;
            var n=index+1;
            goTo(n>maxIndex()?0:n);
          }, AUTO_MS);
        }
      };

      var pauseThenResume=function(){
        stopAuto();
        resumeTimer=setTimeout(startAuto, 5000);
      };

      var goTo=function(i, smooth){
        if(isMobile()){
          var card=slides[i];
          if(!card) return;
          index=i;
          track.scrollTo({ left: cardLeft(card), behavior: smooth===false?'auto':'smooth' });
          syncDots();
          return;
        }
        if(slideW<2) measureDesktop();
        index=Math.max(0, Math.min(i, maxIndex()));
        track.style.transform='translate3d('+(-(index*(slideW+gap)))+'px,0,0)';
        syncDots();
      };

      var syncIndexFromScroll=function(){
        if(!isMobile()) return;
        var left=track.scrollLeft;
        var best=0, bestDist=Infinity;
        for(var i=0;i<slides.length;i++){
          var dist=Math.abs(cardLeft(slides[i])-left);
          if(dist<bestDist){ bestDist=dist; best=i; }
        }
        index=best;
        syncDots();
      };

      var refreshMode=function(){
        stopAuto();
        if(isMobile()){
          clearSlideStyles();
          track.scrollLeft=0;
          index=0;
          buildDots();
          syncFoot();
          syncDots();
          startAuto();
        }else{
          track.scrollLeft=0;
          measureDesktop();
          buildDots();
          syncFoot();
          goTo(Math.min(index, maxIndex()), false);
          startAuto();
        }
      };

      var step=function(dir){
        if(isMobile()){
          var i=index+dir;
          if(i>=slides.length) i=0;
          if(i<0) i=slides.length-1;
          goTo(i, true);
          pauseThenResume();
          return;
        }
        measureDesktop();
        var i=index+dir;
        if(i>maxIndex()) i=0;
        if(i<0) i=maxIndex();
        goTo(i);
        pauseThenResume();
      };

      if(prev) prev.addEventListener('click', function(e){ e.preventDefault(); e.stopPropagation(); step(-1); });
      if(next) next.addEventListener('click', function(e){ e.preventDefault(); e.stopPropagation(); step(1); });

      if(!isMobile()){
        var onDown=function(clientX, pointerId){
          dragging=true; didSwipe=false; startX=clientX; deltaX=0;
          stopAuto();
          track.style.transition='none';
          track.classList.add('is-dragging');
          if(pointerId!=null){ try{ track.setPointerCapture(pointerId); }catch(err){} }
        };
        var onMove=function(clientX){
          if(!dragging) return;
          deltaX=clientX-startX;
          if(Math.abs(deltaX)>8) didSwipe=true;
          track.style.transform='translate3d('+(-(index*(slideW+gap)-deltaX))+'px,0,0)';
        };
        var onUp=function(){
          if(!dragging) return;
          dragging=false;
          track.style.transition='';
          track.classList.remove('is-dragging');
          if(didSwipe && Math.abs(deltaX)>40) step(deltaX<0?1:-1);
          else { goTo(index); startAuto(); }
          setTimeout(function(){ didSwipe=false; deltaX=0; }, 0);
        };
        track.addEventListener('dragstart', function(e){ e.preventDefault(); });
        if(window.PointerEvent){
          track.addEventListener('pointerdown', function(e){ if(e.pointerType==='mouse'&&e.button!==0) return; onDown(e.clientX, e.pointerId); });
          track.addEventListener('pointermove', function(e){ onMove(e.clientX); });
          track.addEventListener('pointerup', onUp);
          track.addEventListener('pointercancel', onUp);
        }
        track.addEventListener('click', function(e){ if(didSwipe){ e.preventDefault(); e.stopPropagation(); didSwipe=false; } }, true);
      }else{
        track.addEventListener('scroll', syncIndexFromScroll, {passive:true});
        track.addEventListener('touchstart', pauseThenResume, {passive:true});
        track.addEventListener('pointerdown', pauseThenResume, {passive:true});
      }

      var canHover=false;
      try{ canHover=window.matchMedia('(hover:hover) and (pointer:fine)').matches; }catch(e){}
      if(canHover){ root.addEventListener('mouseenter', stopAuto); root.addEventListener('mouseleave', startAuto); }
      document.addEventListener('visibilitychange', function(){
        if(document.hidden) stopAuto();
        else startAuto();
      });

      var resizeTimer=null;
      window.addEventListener('resize', function(){
        clearTimeout(resizeTimer);
        resizeTimer=setTimeout(refreshMode, 120);
      });
      window.addEventListener('orientationchange', function(){ setTimeout(refreshMode, 180); });
      window.addEventListener('load', function(){ setTimeout(refreshMode, 50); });

      refreshMode();
      requestAnimationFrame(function(){ refreshMode(); setTimeout(refreshMode, 250); });
    }

    initHomeCarousel(document.querySelector('[data-ind-carousel]'), {
      viewportSel: '.ind-viewport',
      trackSel: '.ind-track',
      slideSel: '.ind-slide',
      prevSel: '.ind-prev',
      nextSel: '.ind-next',
      dotsSel: '[data-ind-dots]',
      dotClass: 'ind-dot',
      desktopPer: 5,
      autoMs: 4000
    });

    var svcRoots=document.querySelectorAll('[data-svc-carousel]');
    for(var r=0;r<svcRoots.length;r++){
      initHomeCarousel(svcRoots[r], {
        viewportSel: '.svc-viewport',
        trackSel: '.svc-track',
        slideSel: '.svc-slide',
        prevSel: '.svc-prev',
        nextSel: '.svc-next',
        dotsSel: '[data-svc-dots]',
        dotClass: 'svc-dot',
        desktopPer: parseInt(svcRoots[r].getAttribute('data-per-desktop')||'3',10)||3,
        autoMs: 4500
      });
    }
  })();
})();
