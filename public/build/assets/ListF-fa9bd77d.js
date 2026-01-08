import{r as _,o as d,d as a,a as e,e as b,F as r,f as c,t as i,b as u,J as m}from"./app-e263ac0f.js";import p from"./ViewOrdonnance-d0bd9396.js";import h from"./EditOdonnance-173ce5b6.js";import"./index.min-40c7dc60.js";import"./FooterDocteur-aa572583.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./print-b31df52a.js";import"./CreateMedicament-668a0d1a.js";const g={class:"tab-pane fade",id:"pills-ordonnances-fill",role:"tabpanel","aria-labelledby":"pills-ordonnances-tab-fill"},f=e("div",{class:"text-right"},[e("button",{type:"button",class:"btn btn-outline-primary mb-1 mr-2 mt-0 text-black","data-toggle":"modal","data-target":".bd-Addconsultations-modal-xl",style:{"font-size":"15px"}},[e("i",{class:"ri-add-fill"}),b(" Ajouter Ordonnances ")])],-1),v={class:"row"},y={class:"col-sm-12"},O={class:"iq-card"},C={class:"iq-card-body"},k={id:"table",class:"table-editable"},w={class:"table table-bordered table-responsive-md table-striped text-center"},x=e("thead",null,[e("tr",null,[e("th",null,"Date"),e("th",null,"Nombre Médicaments"),e("th",null,"Aperçu"),e("th",null,"Modifier"),e("th",null,"Supprimer")])],-1),E={contenteditable:"false"},M={contenteditable:"false"},S={class:"text-left font-weight-bold"},$={style:{"text-align":"left"}},D=["onClick"],F=e("i",{class:"ri-eye-line"},null,-1),T=[F],N=["onClick"],j=e("i",{class:"ri-edit-2-fill"},null,-1),z=[j],A=["onClick"],B=e("i",{class:"ri-delete-bin-6-line"},null,-1),J=[B],P={contenteditable:"false"},q={contenteditable:"false"},L={class:"mt-3"},H={style:{"list-style":"square","text-align":"left"}},V={contenteditable:"false"},W=["onClick"],I=e("i",{class:"ri-eye-line"},null,-1),Y=[I],G={components:{OrdonnanceModal:p,EditOrdonnance:h},props:["data","errors"],data(){return{selectedOrdonnance:null,selectedOrdonnanceToEdit:null}},methods:{getDocuments(){m.get("/ordonnances",data.ordonnances,{preserveState:!0,preserveScroll:!0})},showOrdonnanceModal(o){this.selectedOrdonnance=o},showEditOrdonnanceModal(o){this.selectedOrdonnanceToEdit=o},deleteOrdonnance(o){m.delete(`/ordonnances/${o.id}`,{preserveState:!0,preserveScroll:!0,onSuccess:s=>{useToast().success("Bien Supprimer",{position:"bottom-right",duration:3e3})}})},printInvoice(o){this.selectedOrdonnance=o;const s=document.getElementById("printable-contentOrdonnance").innerHTML,l=document.createElement("iframe");l.style.display="none",document.body.appendChild(l);const t=l.contentWindow.document;t.open(),t.write(`
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
          <body>${s}</body>
        </html>
      `),t.close(),l.contentWindow.focus(),l.contentWindow.print(),document.body.removeChild(l)}}},ne=Object.assign(G,{__name:"ListF",props:{ordonnances:Object,patient:Object,medicaments:Object,factures:Object},setup(o){return _(""),(s,l)=>(d(),a("div",g,[f,e("div",v,[e("div",y,[e("div",O,[e("div",C,[b(" fac "),e("div",k,[e("table",w,[x,e("tbody",null,[(d(!0),a(r,null,c(o.ordonnances,t=>(d(),a("tr",{key:t.id},[e("td",E,i(t.dateOrdonnance),1),e("td",M,[(d(!0),a(r,null,c(t.medicaments,n=>(d(),a("div",{key:n.id},[e("h6",S,i(n.nomMedicament+" "+n.dosageMedicament+" "+n.uniteDosageMedicament),1),e("ul",null,[e("li",$,i(n.pivot.NombreComprime+" CP x "+n.pivot.quantiteParJour+" Jour "+n.pivot.momentDePrise+" Pendant "+n.pivot.dureeNombre+" "+n.pivot.duree),1)])]))),128))]),e("td",null,[e("button",{type:"button",onClick:n=>s.showOrdonnanceModal(t),"data-toggle":"modal","data-target":".bd-Ordonnanceview-modal-xl",class:"btn btn-outline-success mb-1 mt-3"},T,8,D)]),e("td",null,[e("button",{type:"button",onClick:n=>s.showEditOrdonnanceModal(t),"data-toggle":"modal","data-target":".bd-OrdonnanceEdit-modal-xl",class:"btn btn-outline-success mb-1 mt-3"},z,8,N)]),e("td",null,[e("button",{onClick:n=>s.deleteOrdonnance(t),type:"button",class:"btn btn-outline-danger mb-1 mt-3"},J,8,A)])]))),128)),(d(!0),a(r,null,c(o.factures,t=>(d(),a("tr",{key:t.id},[e("td",P,i(t.id),1),e("td",q,i(t.dateFacture),1),e("td",null,[e("ol",L,[(d(!0),a(r,null,c(JSON.parse(t.soins),n=>(d(),a("li",H,i(n.libelleSoin)+" - "+i(n.montantSoin)+" DH ",1))),256))])]),e("td",V,i(t.montantFacture),1),e("td",null,[e("button",{type:"button",onClick:n=>s.showFactureModal(t),"data-toggle":"modal","data-target":".bd-Factureview-modal-xl",class:"btn btn-outline-success mb-1 mt-3"},Y,8,W)])]))),128))])]),u(p,{patient:o.patient,ordonnance:s.selectedOrdonnance,onClose:l[0]||(l[0]=t=>s.selectedOrdonnance=null)},null,8,["patient","ordonnance"]),u(h,{ordonnance:s.selectedOrdonnanceToEdit,onClose:l[1]||(l[1]=t=>s.selectedOrdonnanceToEdit=null),medicaments:o.medicaments},null,8,["ordonnance","medicaments"])])])])])])]))}});export{ne as default};
