function a(r,o,i={}){const n=document.querySelector(r);if(!n)return;const{successIcon:t=`<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>`,successText:c="Copied!",duration:d=2e3}=i,e=document.createElement("textarea");e.value=n.textContent,document.body.appendChild(e),e.select(),document.execCommand("copy"),document.body.removeChild(e);const s=o.innerHTML;o.innerHTML=t?`${t}${c}`:c,setTimeout(()=>{o.innerHTML=s},d)}window.copyToClipboard=a;
