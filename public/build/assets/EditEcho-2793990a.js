import{r as c,y as g,q as v,o as E,d as b,a,t as y,h as _,e as l,F as x,k as w,J as S,C,D,ad as I}from"./app-e263ac0f.js";import{i as M}from"./index.min-40c7dc60.js";import{C as N}from"./ckeditor-d4815e6d.js";import"./print-b31df52a.js";import{_ as k}from"./_plugin-vue_export-helper-c27b6911.js";const p=i=>(C("data-v-007790cf"),i=i(),D(),i),z={hidden:""},F={class:"modal fade bd-EchographieEdit-modal-xl",tabindex:"-1",id:"EchographieEdit",role:"dialog",style:{display:"none"},"aria-hidden":"true"},T={class:"modal-dialog modal-xl"},j={class:"modal-content"},B=w('<div class="modal-header bg-secondary" data-v-007790cf><h5 class="modal-title text-white" data-v-007790cf>Modifier Echographie </h5><button type="button" class="close" data-dismiss="modal" aria-label="Close" data-v-007790cf><span aria-hidden="true" data-v-007790cf>×</span></button></div><div class="modal-body d-flex justify-content-center" data-v-007790cf><div id="printable-content" style="width:1070px;" data-v-007790cf><textarea id="editorE" data-v-007790cf></textarea></div><div class="footer-cer" data-v-007790cf></div><div class="text-left" data-v-007790cf></div></div>',2),J={class:"modal-footer"},L=p(()=>a("i",{class:"ri-printer-line"},null,-1)),O=p(()=>a("i",{class:"ri-bill-fill"},null,-1)),V={__name:"EditEcho",props:{patient:Object,echographieEdit:Object,age:Number},setup(i){const n=i;c("");const h=c({}),m=async e=>{try{const o=`Echographies/${n.patient.id}/${e}.html`,r=await I.get(`/storage/${o}`);if(r.status===200)h.value[e]=r.data,s&&s.setData(r.data);else throw new Error("File not found")}catch(t){console.error("Error fetching file:",t.message)}};let s=null,d="";g(()=>n.echographieEdit.contenuEcho,e=>{e&&m(e).then(t=>{d=t}).catch(t=>{console.error("Error fetching content:",t.message)})}),v(()=>{n.patient&&N.create(document.querySelector("#editorE"),{toolbar:{items:["selectAll","|","heading","|","bold","italic","|","bulletedList","numberedList","|","outdent","indent","|","undo","redo","-"],shouldNotGroupWhenFull:!0}}).then(o=>{o.setData(d),s=o,s.model.document.on("change:data",()=>{EchographieEdit.contenu=s.getData()})}).catch(o=>{console.error("Error during initialization of the editor",o)});const t=new Date().toJSON().slice(0,10).split("-");EchographieEdit.dateEcho=`${t[0]}-${t[1]}-${t[2]}`});const u=e=>{let t=s.getData();S.visit(`/Echographies/${e.id}`,{method:"put",data:{...e,contenuEcho:t},preserveState:!0,preserveScroll:!0,onSuccess:o=>{M.useToast().success("Echographie Modifier",{position:"bottom-right",duration:3e3}),$("#EchographieEdit").modal("hide")},onError:o=>{}})},f=()=>{let e=s.getData(),t=window.frames.print_frame;t.document.body.innerHTML=`
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
                    margin-top:500px;
                }
            </style>
            <div class="print-container">`+e+"</div>",t.focus(),t.print()};return(e,t)=>(E(),b(x,null,[a("p",z,y(i.echographieEdit.patient=i.patient),1),a("div",null,[a("div",F,[a("div",T,[a("div",j,[a("form",{onSubmit:t[2]||(t[2]=_((...o)=>e.submit&&e.submit(...o),["prevent"]))},[B,a("div",J,[a("button",{style:{"font-size":"20px"},onClick:t[0]||(t[0]=o=>f()),type:"button",class:"btn btn-outline-primary mt-3"},[L,l("Imprimer ")]),a("button",{style:{"font-size":"20px"},type:"submit",onClick:t[1]||(t[1]=o=>u(e.$props.echographieEdit)),class:"btn mt-3 btn-primary ml-4"},[O,l("Modifier ")])])],32)])])])])],64))}},W=k(V,[["__scopeId","data-v-007790cf"]]);export{W as default};
