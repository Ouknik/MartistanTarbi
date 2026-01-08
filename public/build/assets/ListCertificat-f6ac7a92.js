import h from"./ViewCertificat-66ae7c92.js";import{i as _}from"./index.min-40c7dc60.js";import"./main-ed727b8e.js";import{r as C,o as d,d as l,a as e,F as b,f as g,t as u,n as c,g as v,b as y,J as f,C as P,D as k}from"./app-e263ac0f.js";import{_ as w}from"./_plugin-vue_export-helper-c27b6911.js";import"./FooterDocteur-aa572583.js";const n=i=>(P("data-v-ba75d4b6"),i=i(),k(),i),A={class:"tab-pane fade show",id:"pills-certificats-fill",role:"tabpanel","aria-labelledby":"pills-certificats-tab-fill"},S={class:"text-right"},D={class:"dropdown"},L=n(()=>e("button",{class:"btn btn-outline-primary dropdown-toggle",type:"button",id:"certificatDropdown","data-toggle":"dropdown","aria-haspopup":"true","aria-expanded":"false"}," Ajouter Certificat ",-1)),N={class:"dropdown-menu","aria-labelledby":"certificatDropdown"},j={class:"row"},B={class:"col-sm-12"},I={class:"iq-card"},M={class:"iq-card-body"},O={id:"table",class:"table-editable"},z={class:"table table-bordered table-responsive-md table-striped text-center"},E=n(()=>e("thead",null,[e("tr",null,[e("th",null,"N°"),e("th",null,"Date "),e("th",null,"Certificat"),e("th",{colspan:"4"},"Opération")])],-1)),F={contenteditable:"false"},G={contenteditable:"false"},R={contenteditable:"false"},q=["onClick"],T=n(()=>e("i",{class:"ri-eye-line"},null,-1)),V=[T],W=["onClick"],H=n(()=>e("i",{class:"ri-delete-bin-6-line"},null,-1)),J=[H],Y={class:"d-flex justify-content-center"},K={key:0,"aria-label":"Factures pagination"},Q={class:"pagination"},U=["disabled"],X=n(()=>e("span",{"aria-hidden":"true"},"«",-1)),Z=n(()=>e("span",{class:"sr-only"},"First",-1)),x=[X,Z],ee=["disabled"],te=n(()=>e("span",{"aria-hidden":"true"},"‹",-1)),se=n(()=>e("span",{class:"sr-only"},"Previous",-1)),ae=[te,se],ie=["onClick","disabled"],ne=["disabled"],oe=n(()=>e("span",{"aria-hidden":"true"},"›",-1)),re=n(()=>e("span",{class:"sr-only"},"Next",-1)),de=[oe,re],le=["disabled"],ce=n(()=>e("span",{"aria-hidden":"true"},"»",-1)),pe=n(()=>e("span",{class:"sr-only"},"Last",-1)),ue=[ce,pe],me={components:{CertificatModal:h},props:["data","errors"],data(){return{selectedCertificat:null,perPage:5,currentPage:1}},computed:{paginatedCertificats(){const i=(this.currentPage-1)*this.perPage,o=i+this.perPage;return this.certificats.slice(i,o)},totalPages(){return Math.ceil(this.certificats.length/this.perPage)}},methods:{getAntecedents(){f.get("/certificats",data.certificats,{preserveState:!0,preserveScroll:!0})},showCertificatModal(i){this.selectedCertificat=i},deleteCertificat(i){f.delete(`/certificats/${i.id}`,{preserveState:!0,preserveScroll:!0,onSuccess:o=>{_.useToast().info("Bien Supprimer",{position:"bottom-right",duration:3e3})}})},printInvoice(){const i=document.getElementById("printable-content").innerHTML,o=document.createElement("iframe");o.style.display="none",document.body.appendChild(o);const r=o.contentWindow.document;r.open(),r.write(`
        <!DOCTYPE html>
        <html>
          <head>
            <style>
            @page {
                size: 210mm 297mm;
      }
            #printable-content{
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
    margin-bottom: 20px;
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

.invoice-details p {

}

            </style>
          </head>
          <body>${i}</body>
        </html>
      `),r.close(),o.contentWindow.focus(),o.contentWindow.print(),document.body.removeChild(o)}}},be=Object.assign(me,{__name:"ListCertificat",props:{certificats:Object,patient:Object,docteur:Object,age:Number},setup(i){C("");const o=t=>new Date(t).toLocaleDateString("en-GB"),r=t=>{switch(t){case"Consultation":p("#AddCertificatConsultation");break;case"Repos":p("#AddCertificatRepos");break;case"Grossesse":p("#AddCertificatGrossesse");break;case"Accompagnement":p("#AddCertificatAccompagnement");break}},p=t=>{const s=document.querySelector(t);s&&$(s).modal("show")};return(t,s)=>(d(),l("div",A,[e("div",S,[e("div",D,[L,e("div",N,[e("a",{class:"dropdown-item",href:"#",onClick:s[0]||(s[0]=a=>r("Consultation"))},"Certificat Consultation"),e("a",{class:"dropdown-item",href:"#",onClick:s[1]||(s[1]=a=>r("Repos"))},"Certificat Repos"),e("a",{class:"dropdown-item",href:"#",onClick:s[2]||(s[2]=a=>r("Grossesse"))},"Certificat Grossesse"),e("a",{class:"dropdown-item",href:"#",onClick:s[3]||(s[3]=a=>r("Accompagnement"))},"Certificat Accompagnement")])])]),e("div",j,[e("div",B,[e("div",I,[e("div",M,[e("div",O,[e("table",z,[E,e("tbody",null,[(d(!0),l(b,null,g(t.paginatedCertificats,a=>(d(),l("tr",{key:a.id},[e("td",F,u(a.id),1),e("td",G,u(o(a.dateCertificat)),1),e("td",R,u(a.typeCertificat),1),e("td",null,[e("button",{type:"button",onClick:m=>t.showCertificatModal(a),"data-toggle":"modal","data-target":".bd-certificatview-modal-lg",class:"btn btn-outline-success mb-1 mt-3"},V,8,q)]),e("td",null,[e("button",{onClick:m=>t.deleteCertificat(a),type:"button",class:"btn btn-outline-danger mb-1 mt-3"},J,8,W)])]))),128))])]),e("div",Y,[i.certificats.length>t.perPage?(d(),l("nav",K,[e("ul",Q,[e("li",{class:c(["page-item",{disabled:t.currentPage===1}])},[e("button",{class:"page-link",onClick:s[4]||(s[4]=a=>t.currentPage=1),disabled:t.currentPage===1,"aria-label":"First"},x,8,U)],2),e("li",{class:c(["page-item",{disabled:t.currentPage===1}])},[e("button",{class:"page-link",onClick:s[5]||(s[5]=a=>t.currentPage-=1),disabled:t.currentPage===1,"aria-label":"Previous"},ae,8,ee)],2),(d(!0),l(b,null,g(t.totalPages,a=>(d(),l("li",{class:c(["page-item",{active:t.currentPage===a}]),key:a},[e("button",{class:"page-link",onClick:m=>t.currentPage=a,disabled:t.currentPage===a},u(a),9,ie)],2))),128)),e("li",{class:c(["page-item",{disabled:t.currentPage===t.totalPages}])},[e("button",{class:"page-link",onClick:s[6]||(s[6]=a=>t.currentPage+=1),disabled:t.currentPage===t.totalPages,"aria-label":"Next"},de,8,ne)],2),e("li",{class:c(["page-item",{disabled:t.currentPage===t.totalPages}])},[e("button",{class:"page-link",onClick:s[7]||(s[7]=a=>t.currentPage=t.totalPages),disabled:t.currentPage===t.totalPages,"aria-label":"Last"},ue,8,le)],2)])])):v("",!0)]),y(h,{age:i.age,patient:i.patient,docteur:i.docteur,certificat:t.selectedCertificat,onClose:s[8]||(s[8]=a=>t.selectedCertificat=null)},null,8,["age","patient","docteur","certificat"])])])])])])]))}}),ye=w(be,[["__scopeId","data-v-ba75d4b6"]]);export{ye as default};
