(function(){
  /* ---------- SETTINGS ---------- */
  const passed = window.KRP_CONFIG || {};
  const CONFIG = {
    openDelayMs: 10000,
    endpoint: passed.endpoint || "",
    csrf: passed.csrf || "",
    storageKey: "kodrank_blog_popup_sent"
  };

  const $ = (s,r=document)=>r.querySelector(s);
  const overlay=$("#krp"), form=$("#krp-form"), teaser=$("#krp-teaser"), main=$("#krp-main");
  let lastFocus=null, animated=false;

  const store={
    get(){try{return JSON.parse(localStorage.getItem(CONFIG.storageKey))||{}}catch(e){return{}}},
    set(v){try{localStorage.setItem(CONFIG.storageKey,JSON.stringify({...store.get(),...v}))}catch(e){}}
  };
  function canAutoOpen(){
    return !store.get().submitted;
  }

  const modal=overlay.querySelector(".krp-modal"), scroller=$("#krp-scroll");
  const isSheet=()=>matchMedia("(max-width:900px)").matches;
  let pushedState=false;

  function open(){
    if(overlay.classList.contains("is-open")) return;
    lastFocus=document.activeElement;
    overlay.setAttribute("aria-hidden","false");
    overlay.classList.add("is-open");
    document.documentElement.style.overflow="hidden";
    teaser.classList.remove("is-visible");
    scroller.scrollTop=0;
    runMetrics();
    // phone back button closes the popup instead of leaving the blog
    try{history.pushState({krp:1},"");pushedState=true;}catch(e){}
    // on desktop focus the first choice; on phones skip it so the keyboard doesn't pop up
    if(!isSheet()) setTimeout(()=>{const c=overlay.querySelector(".krp-chip"); c&&c.focus({preventScroll:true});},400);
  }
  function close(fromHistory){
    if(!overlay.classList.contains("is-open")) return;
    overlay.classList.remove("is-open");
    overlay.setAttribute("aria-hidden","true");
    modal.style.transform="";
    document.documentElement.style.overflow="";
    if(pushedState){pushedState=false; if(!fromHistory){try{history.back();}catch(e){}}}
    if(!store.get().submitted){store.set({dismissedAt:Date.now()});setTimeout(()=>teaser.classList.add("is-visible"),600);}
    lastFocus&&lastFocus.focus&&lastFocus.focus({preventScroll:true});
  }
  window.addEventListener("popstate",()=>{ if(overlay.classList.contains("is-open")) close(true); });

  /* swipe down to close (phones/tablets) — from the handle, or anywhere once scrolled to top */
  (function(){
    let startY=0, dy=0, dragging=false;
    function start(e){
      if(!isSheet()) return;
      const onHandle=e.target.closest("#krp-handle");
      if(!onHandle && scroller.scrollTop>0) return;
      if(e.target.closest("input,button")) return;
      startY=e.touches[0].clientY; dy=0; dragging=true;
    }
    function move(e){
      if(!dragging) return;
      dy=e.touches[0].clientY-startY;
      if(dy<=0){modal.style.transform="";return;}
      overlay.classList.add("is-dragging");
      modal.style.transform="translateY("+dy+"px)";
      if(e.cancelable) e.preventDefault();
    }
    function end(){
      if(!dragging) return; dragging=false;
      overlay.classList.remove("is-dragging");
      if(dy>110) close(); else modal.style.transform="";
    }
    modal.addEventListener("touchstart",start,{passive:true});
    modal.addEventListener("touchmove",move,{passive:false});
    modal.addEventListener("touchend",end);
    modal.addEventListener("touchcancel",end);
  })();
  overlay.addEventListener("click",e=>{ if(e.target===overlay||e.target.closest("[data-krp-close]")) close(); });
  teaser.addEventListener("click",open);
  document.addEventListener("keydown",e=>{
    if(!overlay.classList.contains("is-open")) return;
    if(e.key==="Escape") close();
    if(e.key==="Tab"){
      const f=[...overlay.querySelectorAll("button,input:not([tabindex='-1'])")].filter(el=>el.offsetParent!==null&&!el.closest(".krp-hp"));
      if(!f.length) return;
      if(e.shiftKey&&document.activeElement===f[0]){e.preventDefault();f[f.length-1].focus();}
      else if(!e.shiftKey&&document.activeElement===f[f.length-1]){e.preventDefault();f[0].focus();}
    }
  });

  if(overlay && overlay.parentElement !== document.body) document.body.appendChild(overlay);
  if(teaser && teaser.parentElement !== document.body) document.body.appendChild(teaser);

  /* open once, 10s after this article loads. A sent form stays closed. */
  if(overlay && canAutoOpen()) setTimeout(open, CONFIG.openDelayMs);
  else if(teaser && !store.get().submitted) teaser.classList.add("is-visible");

  /* rank climb + speed drop animation */
  function runMetrics(){
    if(animated) return; animated=true;
    const rank=$("#krp-rank"), speed=$("#krp-speed"), t0=performance.now(), dur=1600;
    (function tick(t){
      const k=Math.min(1,(t-t0)/dur), e=1-Math.pow(1-k,3);
      rank.textContent=Math.round(27-(27-3)*e);
      speed.textContent=(6.8-(6.8-1.2)*e).toFixed(1);
      if(k<1) requestAnimationFrame(tick);
    })(t0);
  }

  /* service chips */
  const chipsWrap=$("#krp-chips"), chips=[...chipsWrap.querySelectorAll(".krp-chip")];
  chips.forEach(c=>c.addEventListener("click",()=>{
    c.setAttribute("aria-pressed",c.getAttribute("aria-pressed")==="true"?"false":"true");
    $("#krp-service").value=chips.filter(x=>x.getAttribute("aria-pressed")==="true").map(x=>x.dataset.value).join(", ");
    if($("#krp-service").value){chipsWrap.classList.remove("has-error");form.classList.remove("krp-chip-error");}
  }));
  const msg=$("#krp-msg");
  msg.addEventListener("input",()=>{msg.style.height="auto";msg.style.height=msg.scrollHeight+"px";msg.style.overflowY=msg.scrollHeight>msg.clientHeight+1?"auto":"hidden";});

  /* validation */
  const rules={
    name:v=>v.trim().length>=2,
    phone:v=>v.replace(/[^\d]/g,"").length>=10,
    email:v=>/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim())
  };
  const fields=["krp-name","krp-phone","krp-email"].map(id=>$("#"+id));
  function validate(i){
    const ok=rules[i.name](i.value);
    i.closest(".krp-field").classList.toggle("has-error",!ok);
    i.setAttribute("aria-invalid",String(!ok));
    return ok;
  }
  fields.forEach(i=>{
    i.addEventListener("blur",()=>i.value&&validate(i));
    i.addEventListener("input",()=>i.closest(".krp-field").classList.contains("has-error")&&validate(i));
  });

  /* submit */
  form.addEventListener("submit",async e=>{
    e.preventDefault();
    $("#krp-form-err").style.display="none";
    const serviceOk=!!$("#krp-service").value;
    chipsWrap.classList.toggle("has-error",!serviceOk);
    form.classList.toggle("krp-chip-error",!serviceOk);
    const bad=fields.filter(i=>!validate(i));
    if(!serviceOk){chips[0].focus();return;}
    if(bad.length){bad[0].focus();return;}
    if(form.company_fax.value) return; // spam bot

    const btn=$("#krp-submit"); btn.classList.add("is-loading");
    const payload={
      service:form.service.value,
      name:form.name.value.trim(),
      phone:form.phone.value.trim(),
      email:form.email.value.trim(),
      message:form.message.value.trim(),
      source:"blog-popup",
      page:location.href,
      post_title:document.title
    };
    try{
      const r=await fetch(CONFIG.endpoint,{
        method:"POST",
        headers:{
          "Content-Type":"application/json",
          "Accept":"application/json",
          "X-CSRF-TOKEN":CONFIG.csrf
        },
        body:JSON.stringify(payload)
      });
      if(!r.ok) throw new Error("failed");
      store.set({submitted:true});
      $("#krp-done-lede").textContent="Thanks, "+payload.name.split(" ")[0]+". Here’s what happens next.";
      main.classList.add("is-done");
      main.scrollTop=0; scroller.scrollTop=0;
    }catch(err){
      $("#krp-form-err").style.display="block";
    }finally{
      btn.classList.remove("is-loading");
    }
  });
})();
