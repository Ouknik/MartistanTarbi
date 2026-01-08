import{r,P as b,y as _,o as v,d as y,a as t,t as l,u as m,h as x,e as h,F as E,k as C,J as D}from"./app-e263ac0f.js";import{i as c}from"./index.min-40c7dc60.js";import{C as S}from"./ckeditor-d4815e6d.js";import"./print-b31df52a.js";const w={hidden:""},z={class:"modal fade bd-Echographie-modal-xl",tabindex:"-1",id:"Echographie",role:"dialog",style:{display:"none"},"aria-hidden":"true"},T={class:"modal-dialog modal-xl"},B={class:"modal-content"},N={class:"modal-header bg-secondary"},j={class:"modal-title text-white"},k=t("button",{type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},[t("span",{"aria-hidden":"true"},"×")],-1),F=C('<div class="modal-body d-flex justify-content-center"><div id="printable-content" style="width:1070px;"><textarea id="editorCreate"></textarea></div><div class="footer-cer"></div><div class="text-left"></div></div>',1),A={class:"modal-footer"},L=t("i",{class:"ri-printer-line"},null,-1),V=t("button",{style:{"font-size":"20px"},type:"submit",class:"btn mt-3 btn-primary ml-4"},[t("i",{class:"ri-bill-fill"}),h("Ajouter ")],-1),q={__name:"Create",props:{patient:Object,idConsultation:Number,content:String,nomEcho:String},setup(s){const a=s,d=r(""),n=b({typeEcho:"",contenu:"",patient:"",dateEcho:"",consultation_id:""});r(""),r({});const f=()=>{if(a.idConsultation==0)return c.useToast().error("Veuillez Choisir une consultation ",{position:"bottom-right",duration:3e3}),!1;n.typeEcho=a.nomEcho,D.visit("/Echographies",{method:"post",data:n,preserveState:!0,preserveScroll:!0,errorBag:null,forceFormData:!0,onProgress:e=>{},onSuccess:e=>{c.useToast().success("Echographie Debut Grossesse Bien Ajouter avec ",{position:"bottom-right",duration:3e3}),$("#Echographie").modal("hide")},onError:e=>{c.useToast().error("Veuillez remplir tout les champs",{position:"bottom-right",duration:3e3})}})};let i=null,u=r("");u.value=d.value||"<h3>Default Content if props.content is empty</h3>",_(()=>d.value,e=>{u.value=e||"<h3>Default Content if props.content22 is empty</h3>",a.patient&&(i?i.destroy().then(()=>{p(e)}):p(e))});function p(e){S.create(document.querySelector("#editorCreate"),{toolbar:{items:["selectAll","|","heading","|","bold","italic","|","bulletedList","numberedList","|","outdent","indent","|","undo","redo","-","|"],shouldNotGroupWhenFull:!0}}).then(o=>{o.setData(e),i=o,n.contenu=i.getData(),i.model.document.on("change:data",()=>{n.contenu=i.getData()})}).catch(o=>{console.error("Error during initialization of the editor",o)})}const g=()=>{let e=i.getData(),o=window.frames.print_frame;o.document.body.innerHTML=`
            <style>
                body  {
                    margin: 0;
                    padding: 0;
                }
                .print-container {
                    margin-top: 130px;
                    padding : 10px;
                }
                
                .titre{
                    text-align:center;
                    font-size: 9px;
                    color:red;
                }
               
            </style>
            <div class="print-container" >`+e+"</div>",o.focus(),o.print()};return(e,o)=>(v(),y(E,null,[t("p",w,l(m(n).patient=s.patient)+" "+l(m(n).consultation_id=s.idConsultation)+" "+l(d.value=a.content),1),t("div",null,[t("div",z,[t("div",T,[t("div",B,[t("form",{onSubmit:x(f,["prevent"])},[t("div",N,[t("h5",j,l(s.nomEcho),1),k]),F,t("div",A,[t("button",{style:{"font-size":"20px"},onClick:o[0]||(o[0]=G=>g()),type:"button",class:"btn btn-outline-primary mt-3"},[L,h("Imprimer ")]),V])],32)])])])])],64))}};export{q as default};
