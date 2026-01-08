import{o as i,d as l,a as t,h as m,b as u,t as s,F as h,f,g as d,e as r}from"./app-e263ac0f.js";import{H as _,F as b}from"./FooterDocteur-aa572583.js";import"./print-b31df52a.js";import"./_plugin-vue_export-helper-c27b6911.js";const y={class:"modal fade bd-Factureview-modal-lg",tabindex:"-1",role:"dialog",style:{display:"none"},"aria-hidden":"true"},p={class:"modal-dialog modal-lg"},g={class:"modal-content"},v=t("div",{class:"modal-header bg-secondary"},[t("h5",{class:"modal-title text-white"}," Note d'honoration "),t("button",{type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},[t("span",{"aria-hidden":"true"},"×")])],-1),x={key:0,class:"modal-body"},D={id:"printable-contentFacture"},w={class:"header",style:{"text-align":"center"}},F={style:{"font-size":"18px"}},k=t("h1",{class:"ordonnance mt-1"},"Note d'honoration",-1),N={class:"mt-1",style:{"font-size":"18px"}},H={class:"invoice-details",style:{"font-size":"23px","font-family":"Verdana, Geneva, Tahoma, sans-serif",color:"black","text-align":"justify"}},V={border:"1",style:{width:"100%"}},S=t("thead",{class:"text-center"},[t("tr",null,[t("th",null,"N°"),t("th",null,"Désignation"),t("th",null,"Montant")])],-1),T={key:0,class:"text-center"},j={class:"center"},z={class:"center text-center"},L=t("td",{colspan:"2",class:"text-start font-weight-bold center"},"Total ",-1),M={class:"center font-weight-bold"},B={key:0,class:"text-left text-black",id:"footer-facture",style:{"font-size":"12px"}},C={class:"footer-cer"},I={class:"text-right"},O=t("i",{class:"ri-printer-line"},null,-1),$={data(){return{formattedDate:"",sumDays:0,currentDate:""}},methods:{printInvoice(){let e=document.getElementById("printable-contentFacture").innerHTML,n=window.frames.print_frame;n.document.body.innerHTML=`
            <style>
                body {
                    margin: 0;
                    padding: 0;
                }
                .print-container {
                    margin-top: 110px;
                    padding : 10px;
                }
                .invoice-details {
                    line-height: 1.9; /* Adjust this value to change the line spacing */
                }
                .invoice-details table td {
                    text-align: center;
                }
                .invoice-details table td, .invoice-details table th {
                    border: 1px solid black;
                }

            </style>
            <div class="print-container">`+e+"</div>",n.focus(),n.print()}},mounted(){const e=new Date,n=e.getDate(),a=e.getMonth()+1,o=e.getFullYear();this.currentDate=`${n<10?"0"+n:n}-${a<10?"0"+a:a}-${o}`}},J=Object.assign($,{__name:"ViewFacture",props:{patient:Object,facture:Object},setup(e){return(n,a)=>(i(),l("div",y,[t("div",p,[t("div",g,[t("form",{onSubmit:a[1]||(a[1]=m((...o)=>n.submit&&n.submit(...o),["prevent"]))},[v,e.facture?(i(),l("div",x,[u(_),t("div",D,[t("div",w,[t("h4",F," Taroudant Le : "+s(e.facture.dateFacture)+" : تارودانت في ",1),k,t("h4",N,s(e.patient.nomPatient+" "+e.patient.prenomPatient),1)]),t("div",H,[t("table",V,[S,e.facture?(i(),l("tbody",T,[(i(!0),l(h,null,f(JSON.parse(e.facture.soins),(o,c)=>(i(),l("tr",{key:c},[t("td",j,s(c+1),1),t("td",null,s(o.libelleSoin),1),t("td",z,s(o.montantSoin+" DH"),1)]))),128)),t("tr",null,[L,t("td",M,s(e.facture.montantFacture+" DH"),1)])])):d("",!0)]),e.facture?(i(),l("p",B,[r(" Arrêter la Présente Note à la Somme de "),t("span",null,s(e.facture.montantLettre),1),r(" Dirhams ("),t("span",null,s(e.facture.montantFacture),1),r(" DH ) ")])):d("",!0)])]),t("div",C,[u(b)]),t("div",I,[t("button",{style:{"font-size":"20px"},onClick:a[0]||(a[0]=o=>n.printInvoice()),type:"button",class:"btn btn-outline-primary mt-3"},[O,r("Imprimer ")])])])):d("",!0)],32)])])]))}});export{J as default};
