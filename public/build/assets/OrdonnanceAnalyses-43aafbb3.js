import{o,d as l,a as e,h as u,b as y,t as r,F as c,f as m,g as h,e as p}from"./app-e263ac0f.js";import"./index.min-40c7dc60.js";import{H as f,F as _}from"./FooterDocteur-aa572583.js";import"./print-b31df52a.js";import"./_plugin-vue_export-helper-c27b6911.js";const g={class:"modal fade bd-OronnanceAnalyses-modal-lg",tabindex:"-1",role:"dialog",style:{display:"none"},"aria-hidden":"true"},b={class:"modal-dialog modal-lg"},A={class:"modal-content"},v=e("div",{class:"modal-header bg-secondary"},[e("h5",{class:"modal-title text-white"},"Analyses "),e("button",{type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},[e("span",{"aria-hidden":"true"},"×")])],-1),x={class:"modal-body"},w={hidden:""},O={id:"printable-contentOrdonnanceAnalyse",class:"custom-margin-left",style:{"padding-top":"200px"}},D={class:"header",style:{"text-align":"center"}},k={style:{"font-size":"18px"}},$=e("h1",{class:"ordonnance mt-1"},"Analyses",-1),z={class:"mt-1",style:{"font-size":"18px"}},j={style:{"font-size":"20px","font-family":"Verdana, Geneva, Tahoma, sans-serif",color:"black","text-align":"justify","margin-top":"65px","margin-left":"15px"}},F={contenteditable:"false"},I={class:"Analyse",style:{"text-align":"left"}},M={key:0},N={class:"sousAnalyse ml-4"},S={class:"footer-cer"},T={class:"text-right"},V=e("i",{class:"ri-printer-line"},null,-1),B={data(){return{currentDate:new Date,formattedDate:"",form:{}}},methods:{printInvoice(){let n=800,t=800,s=(screen.width-n)/2,a=(screen.height-t)/2,i=window.open("","",`width=${n},height=${t},top=${a},left=${s}`),d=document.getElementById("printable-contentOrdonnanceAnalyse").outerHTML;i.document.open(),i.document.write(`
        <html>
            <head>
                <title>Ordonnance</title>
                <style>
                    h1.ordonnance {
                        font-size: 35px !important;
                    }
                    #printable-contentOrdonnanceAnalyse{
                        margin-top:-100px;
                    }
                    .Analyse{
                        font-size:15px;

                    }
                    .sousAnalyse{
                        margin-left:20px;
                        font-size:12px;
                    }
                    .familleAnalyse{
                        font-size:13px;
                        margin-bottom:-10px;
                        margin-top:-10px;
                    }

                </style>
            </head>
            <body onload="window.print();window.close()">
                ${d}
            </body>
        </html>
    `),i.document.close()},faAlreadyDisplayed(n){let t=[];for(let s=0;s<this.familleanalyses.length;s++)if(!t.includes(this.familleanalyses[s].id)){if(this.familleanalyses[s].id===n)return t.push(n),!1;t.push(this.familleanalyses[s].id)}return!0},hasMatchingAnalyse(n){return this.analyses.some(t=>t.famille_analyse_id===n)},filteredAnalyses(n){return this.analyses.filter(t=>t.famille_analyse_id===n)}},mounted(){this.$nextTick(()=>{document.querySelector(".bd-OronnanceAnalyses-modal-lg").addEventListener("shown.bs.modal",()=>{this.printInvoice()})});const n=new Date,t=n.getDate(),s=n.getMonth()+1,a=n.getFullYear();this.currentDate=`${t<10?"0"+t:t}-${s<10?"0"+s:s}-${a}`}},q=Object.assign(B,{__name:"OrdonnanceAnalyses",props:{patient:Object,analyses:Object,sousAnalyses:Object,familleanalyses:Object},setup(n){return(t,s)=>(o(),l("div",g,[e("div",b,[e("div",A,[e("form",{onSubmit:s[1]||(s[1]=u((...a)=>t.submit&&t.submit(...a),["prevent"]))},[v,e("div",x,[y(f),e("span",w,r(t.form.date=new Date().toJSON().slice(0,10)),1),e("div",O,[e("div",D,[e("h4",k," Taroudant Le : "+r(t.currentDate)+" : تارودانت في ",1),$,e("h4",z,r(n.patient.nomPatient+" "+n.patient.prenomPatient),1)]),e("div",j,[e("table",null,[e("tr",null,[e("td",F,[(o(!0),l(c,null,m(n.familleanalyses,a=>(o(),l("div",{key:a.id},[t.hasMatchingAnalyse(a.id)?(o(!0),l(c,{key:0},m(t.filteredAnalyses(a.id),i=>(o(),l("span",{key:i.id},[e("ul",null,[e("li",I,r(i.nomAnalyse),1)]),(o(!0),l(c,null,m(n.sousAnalyses,d=>(o(),l("span",{key:d.id},[d.analyse_id==i.id?(o(),l("ul",M,[e("li",N,r(d.nomSousAnalyse),1)])):h("",!0)]))),128))]))),128)):h("",!0)]))),128))])])])])]),e("div",S,[y(_)]),e("div",T,[e("button",{style:{"font-size":"20px"},onClick:s[0]||(s[0]=a=>t.printInvoice()),type:"button",class:"btn btn-outline-primary mt-3"},[V,p("Imprimer ")])])])],32)])])]))}});export{q as default};
