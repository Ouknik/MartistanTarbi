import{P as y,r as u,q as h,o as _,d as E,a as t,t as c,u as p,h as v,e as l,F as x,J as w}from"./app-e263ac0f.js";import{i as d}from"./index.min-40c7dc60.js";import{C}from"./ckeditor-d4815e6d.js";import"./print-b31df52a.js";const S={hidden:""},j={class:"modal fade bd-EchographieGynecologique-modal-xl",tabindex:"-1",id:"EchographieGynecologique",role:"dialog",style:{display:"none"},"aria-hidden":"true"},q={class:"modal-dialog modal-xl"},G={class:"modal-content"},D=t("div",{class:"modal-header bg-secondary"},[t("h5",{class:"modal-title text-white"},"Echographie Gynecologique"),t("button",{type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},[t("span",{"aria-hidden":"true"},"×")]),l("ghjghj ")],-1),z={class:"modal-body d-flex justify-content-center"},N=t("div",{id:"printable-content",style:{width:"1070px"}},[t("textarea",{id:"editor"})],-1),B=t("div",{class:"footer-cer"},null,-1),F=t("div",{class:"text-left"},null,-1),T={class:"modal-footer"},k=t("i",{class:"ri-printer-line"},null,-1),O=t("button",{style:{"font-size":"20px"},type:"submit",class:"btn mt-3 btn-primary ml-4"},[t("i",{class:"ri-bill-fill"}),l("Ajouter ")],-1),M={__name:"Create",props:{patient:Object,Echographies:Object,age:Number,gestationnelle:Object,idConsultation:Number,content:String,nomEho:String},setup(r){const i=r,s=y({typeEcho:"Echographie Gynecologique",contenu:"",patient:"",dateEcho:"",consultation_id:""});u("");const m=u({}),g=()=>{if(i.idConsultation==0)return d.useToast().error("Veuillez Choisir une consultation ",{position:"bottom-right",duration:3e3}),!1;w.visit("/Echographies",{method:"post",data:s,preserveState:!0,preserveScroll:!0,errorBag:null,forceFormData:!0,onProgress:o=>{},onSuccess:o=>{d.useToast().success("Echographie Debut Grossesse Bien Ajouter avec ",{position:"bottom-right",duration:3e3}),$("#EchographieGynecologique").modal("hide")},onError:o=>{d.useToast().error("Veuillez remplir tout les champs",{position:"bottom-right",duration:3e3})}})},f=async o=>{try{const e=await fetch(`/storage/${o}.html`);if(!e.ok)throw new Error("File not found");const n=await e.text();m.value[o]=n}catch(e){console.error("Error fetching file:",e.message)}};h(()=>{i.Echographies.flat().forEach(o=>{o.contenuEcho&&f(o.contenuEcho)})});let a=null;h(()=>{i.patient&&C.create(document.querySelector("#editor"),{toolbar:{items:["selectAll","|","heading","|","bold","italic","|","bulletedList","numberedList","|","outdent","indent","|","undo","redo","-","|"],shouldNotGroupWhenFull:!0}}).then(n=>{i.content&&n.setData(i.content),a=n,a.model.document.on("change:data",()=>{s.contenu=a.getData()})}).catch(n=>{console.error("Error during initialization of the editor",n)});const e=new Date().toJSON().slice(0,10).split("-");s.dateEcho=`${e[0]}-${e[1]}-${e[2]}`});const b=()=>{let o=a.getData(),e=window.frames.print_frame;e.document.body.innerHTML=`
            <style>
                body  {
                    margin: 0;
                    padding: 0;
                }
                .print-container {
                    margin-top: 110px;
                    padding : 10px;
                }
                
                .titre{
                    text-align:center;
                    font-size: 9px;
                    color:red;
                }
                #printable-content{
                    color:yellow;
                }
            </style>
            <div class="print-container">`+o+"</div>",e.focus(),e.print()};return(o,e)=>(_(),E(x,null,[t("p",S,c(p(s).patient=r.patient)+" "+c(p(s).consultation_id=r.idConsultation),1),t("div",null,[t("div",j,[t("div",q,[t("div",G,[t("form",{onSubmit:v(g,["prevent"])},[D,t("div",z,[l(c(r.nomEho)+" ",1),N,B,F]),t("div",T,[t("button",{style:{"font-size":"20px"},onClick:e[0]||(e[0]=n=>b()),type:"button",class:"btn btn-outline-primary mt-3"},[k,l("Imprimer ")]),O])],32)])])])])],64))}};export{M as default};
