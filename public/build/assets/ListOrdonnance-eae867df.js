import{r as b,o as i,d,a as e,F as c,f as u,t as l,n as r,g as _,b as m,J as p}from"./app-e263ac0f.js";import h from"./ViewOrdonnance-d0bd9396.js";import g from"./EditOdonnance-173ce5b6.js";import{P as f}from"./main-ed727b8e.js";import{i as P}from"./index.min-40c7dc60.js";import v from"./CreateOrdonnances-04191da4.js";import"./FooterDocteur-aa572583.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./print-b31df52a.js";import"./CreateMedicament-668a0d1a.js";const O={class:"tab-pane fade show",id:"pills-ordonnances-fill",role:"tabpanel","aria-labelledby":"pills-ordonnances-tab-fill"},y=e("div",{class:"text-right"},[e("div",{class:"dropdown"},[e("button",{class:"btn btn-outline-primary",type:"button",id:"dropdownMenuButton","data-toggle":"modal","data-target":"#AddOrdonnance","aria-haspopup":"true","aria-expanded":"false"}," Ajouter Ordonnance ")])],-1),k={class:"row"},C={class:"col-sm-12"},w={class:"iq-card"},M={class:"iq-card-body"},E={id:"table",class:"table-editable"},$={class:"table table-bordered table-responsive-md table-striped text-center"},N=e("thead",null,[e("tr",null,[e("th",null,"N°"),e("th",null,"Date"),e("th",null,"Nombre Médicaments"),e("th",null,"Aperçu"),e("th",null,"Modifier"),e("th",null,"Supprimer")])],-1),S={contenteditable:"false"},j={contenteditable:"false"},z={class:"text-left font-weight-bold"},A={style:{"text-align":"left"}},B=["onClick"],D=e("i",{class:"ri-eye-line"},null,-1),F=[D],L=["onClick"],T=e("i",{class:"ri-edit-2-fill"},null,-1),V=[T],W=["onClick"],q=e("i",{class:"ri-delete-bin-6-line"},null,-1),H=[q],I={class:"d-flex justify-content-center"},J={key:0,"aria-label":"Factures pagination"},Y={class:"pagination"},G=["disabled"],K=e("span",{"aria-hidden":"true"},"«",-1),Q=e("span",{class:"sr-only"},"First",-1),R=[K,Q],U=["disabled"],X=e("span",{"aria-hidden":"true"},"‹",-1),Z=e("span",{class:"sr-only"},"Previous",-1),x=[X,Z],ee=["onClick","disabled"],te=["disabled"],ne=e("span",{"aria-hidden":"true"},"›",-1),se=e("span",{class:"sr-only"},"Next",-1),ae=[ne,se],oe=["disabled"],ie=e("span",{"aria-hidden":"true"},"»",-1),de=e("span",{class:"sr-only"},"Last",-1),le=[ie,de],re={components:{OrdonnanceModal:h,EditOrdonnance:g,Pagination:f},props:["data","errors"],data(){return{selectedOrdonnance:null,selectedOrdonnanceToEdit:null,perPage:10,currentPage:1}},computed:{paginatedOrdonnances(){const s=(this.currentPage-1)*this.perPage,t=s+this.perPage;return this.ordonnances.slice(s,t)},totalPages(){return Math.ceil(this.ordonnances.length/this.perPage)}},methods:{changePage(s){this.currentPage=s},getDocuments(){p.get("/ordonnances",data.ordonnances,{preserveState:!0,preserveScroll:!0})},showOrdonnanceModal(s){this.selectedOrdonnance=s},showEditOrdonnanceModal(s){this.selectedOrdonnanceToEdit=s},deleteOrdonnance(s){p.delete(`/ordonnances/${s.id}`,{preserveState:!0,preserveScroll:!0,onSuccess:t=>{P.useToast().info("Bien Supprimer",{position:"bottom-right",duration:3e3})}})},printInvoice(s){this.selectedOrdonnance=s;const t=document.getElementById("printable-contentOrdonnance").innerHTML,a=document.createElement("iframe");a.style.display="none",document.body.appendChild(a);const n=a.contentWindow.document;n.open(),n.write(`
        <!DOCTYPE html>
        <html>
          <head>
            <style>
            @page {
                size: 210mm 297mm;
      }
            #printable-contentFacture{
    padding:15px;


}
body {
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                    // width: 148mm; /* Largeur A5 en mm */
                    // height: 210mm; /* Hauteur A5 en mm */
                    margin: 0;
                    background-color:red;
                }


.header {
    margin-top:31%;
    margin-left:5%;
    margin-bottom:10%;
    font-size:15px;
}

.header h1 {
    font-size: 28px;

}


.invoice-details {
    line-height : 2;
    padding-left:20px;
    padding-right:20px;
}
#footer-facture{
    font-size:18px;
}
.invoice-details p {

}

            </style>
          </head>
          <body>${t}</body>
        </html>
      `),n.close(),a.contentWindow.focus(),a.contentWindow.print(),document.body.removeChild(a)}}},ve=Object.assign(re,{__name:"ListOrdonnance",props:{ordonnances:Object,patient:Object,medicaments:Object,factures:Object,idConsultation:Number},setup(s){return b(""),(t,a)=>(i(),d(c,null,[e("div",O,[y,e("div",k,[e("div",C,[e("div",w,[e("div",M,[e("div",E,[e("table",$,[N,e("tbody",null,[(i(!0),d(c,null,u(t.paginatedOrdonnances,n=>(i(),d("tr",{key:n.id},[e("td",null,l(n.id),1),e("td",S,l(n.dateOrdonnance),1),e("td",j,[(i(!0),d(c,null,u(n.medicaments,o=>(i(),d("div",{key:o.id},[e("h6",z,l(o.nomMedicament+" "+o.dosageMedicament+" "+o.uniteDosageMedicament),1),e("ul",null,[e("li",A,l(o.pivot.prescription),1)])]))),128))]),e("td",null,[e("button",{type:"button",onClick:o=>t.showOrdonnanceModal(n),"data-toggle":"modal","data-target":".bd-Ordonnanceview-modal-lg",class:"btn btn-outline-success mb-1 mt-3"},F,8,B)]),e("td",null,[e("button",{type:"button",onClick:o=>t.showEditOrdonnanceModal(n),"data-toggle":"modal","data-target":".bd-OrdonnanceEdit-modal-lg",class:"btn btn-outline-success mb-1 mt-3"},V,8,L)]),e("td",null,[e("button",{onClick:o=>t.deleteOrdonnance(n),type:"button",class:"btn btn-outline-danger mb-1 mt-3"},H,8,W)])]))),128))])]),e("div",I,[s.ordonnances.length>t.perPage?(i(),d("nav",J,[e("ul",Y,[e("li",{class:r(["page-item",{disabled:t.currentPage===1}])},[e("button",{class:"page-link",onClick:a[0]||(a[0]=n=>t.currentPage=1),disabled:t.currentPage===1,"aria-label":"First"},R,8,G)],2),e("li",{class:r(["page-item",{disabled:t.currentPage===1}])},[e("button",{class:"page-link",onClick:a[1]||(a[1]=n=>t.currentPage-=1),disabled:t.currentPage===1,"aria-label":"Previous"},x,8,U)],2),(i(!0),d(c,null,u(t.totalPages,n=>(i(),d("li",{class:r(["page-item",{active:t.currentPage===n}]),key:n},[e("button",{class:"page-link",onClick:o=>t.currentPage=n,disabled:t.currentPage===n},l(n),9,ee)],2))),128)),e("li",{class:r(["page-item",{disabled:t.currentPage===t.totalPages}])},[e("button",{class:"page-link",onClick:a[2]||(a[2]=n=>t.currentPage+=1),disabled:t.currentPage===t.totalPages,"aria-label":"Next"},ae,8,te)],2),e("li",{class:r(["page-item",{disabled:t.currentPage===t.totalPages}])},[e("button",{class:"page-link",onClick:a[3]||(a[3]=n=>t.currentPage=t.totalPages),disabled:t.currentPage===t.totalPages,"aria-label":"Last"},le,8,oe)],2)])])):_("",!0)]),m(h,{patient:s.patient,ordonnance:t.selectedOrdonnance,onClose:a[4]||(a[4]=n=>t.selectedOrdonnance=null)},null,8,["patient","ordonnance"]),m(g,{ordonnance:t.selectedOrdonnanceToEdit,medicaments:s.medicaments},null,8,["ordonnance","medicaments"])])])])])])]),m(v,{patient:s.patient.id,medicaments:s.medicaments,idConsultation:s.idConsultation},null,8,["patient","medicaments","idConsultation"])],64))}});export{ve as default};
