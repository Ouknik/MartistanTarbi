import{o as s,d as i,a as e,h,c as u,g as l,t as d,F as p,f as g,e as c,b as y}from"./app-e263ac0f.js";import"./index.min-40c7dc60.js";import{F as f,H as _}from"./FooterDocteur-aa572583.js";import"./print-b31df52a.js";import"./_plugin-vue_export-helper-c27b6911.js";const b={class:"modal fade bd-Ordonnanceview-modal-lg",tabindex:"-1",role:"dialog",style:{display:"none"},"aria-hidden":"true"},x={class:"modal-dialog modal-lg"},v={class:"modal-content"},w=e("div",{class:"modal-header bg-secondary"},[e("h5",{class:"modal-title text-white"},"Ordonnance "),e("button",{type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},[e("span",{"aria-hidden":"true"},"×")])],-1),D={key:0,class:"modal-body"},O={hidden:""},z={id:"printable-contentOrdonnance",style:{"padding-top":"120px"}},V={class:"header",style:{"text-align":"center"}},k={style:{"font-size":"18px"}},$=e("h1",{class:"ordonnance mt-1"},"Ordonnance",-1),M={class:"mt-1",style:{"font-size":"18px"}},I={class:"medicaments",style:{"font-size":"20px","font-family":"Verdana, Geneva, Tahoma, sans-serif",color:"black","text-align":"justify","margin-top":"15px","margin-left":"15px"}},N={key:0},R={contenteditable:"false"},B={class:"text-left font-weight-bold",style:{"font-size":"12px","margin-top":"20px"}},C={class:"detailsM",style:{"text-align":"left"}},F={key:0,class:"text-dark float-right mr-5"},T={style:{"font-size":"14px","margin-top":"55px"}},j={class:"footer-cer"},L={class:"text-right"},S=e("i",{class:"ri-printer-line"},null,-1),E={data(){return{formattedDate:"",currentDate:new Date,form:{}}},methods:{printInvoice(){let t=800,o=800,a=(screen.width-t)/2,n=(screen.height-o)/2,r=window.open("","",`width=${t},height=${o},top=${n},left=${a}`),m=document.getElementById("printable-contentOrdonnance").outerHTML;r.document.open(),r.document.write(`
            <html>
                <head>
                    <title>Ordonnance</title>
                    <style>
                        h1.ordonnance {
                            font-size: 35px !important;
                        }
                        #printable-contentOrdonnance{
                            margin-top:10px;
                        }
                        .detailsM{
                            margin-top:-25px;
                            font-size:10px;
                        }
                        .medicaments{
                            margin-top:-40px;
                        }
                    </style>
                </head>
                <body onload="window.print();window.close()">
                    ${m}
                </body>
            </html>
    `),r.document.close()}},mounted(){this.$nextTick(()=>{document.querySelector(".bd-Ordonnanceview-modal-lg").addEventListener("shown.bs.modal",()=>{this.printInvoice()})});const t=new Date,o=t.getDate(),a=t.getMonth()+1,n=t.getFullYear();this.currentDate=`${o<10?"0"+o:o}-${a<10?"0"+a:a}-${n}`}},W=Object.assign(E,{__name:"ViewOrdonnance",props:{patient:Object,age:Number,ordonnance:Object},setup(t){return(o,a)=>(s(),i("div",b,[e("div",x,[e("div",v,[e("form",{onSubmit:a[1]||(a[1]=h((...n)=>o.submit&&o.submit(...n),["prevent"]))},[w,t.ordonnance?(s(),i("div",D,[t.ordonnance.ConsultationDocteurID&&t.ordonnance.ConsultationDocteurID==1?(s(),u(_,{key:0})):l("",!0),e("span",O,d(o.form.date=new Date().toJSON().slice(0,10)),1),e("div",z,[e("div",V,[e("h4",k," Taroudant Le : "+d(t.ordonnance.dateOrdonnance)+" : تارودانت في ",1),$,e("h4",M,d(t.patient.nomPatient+" "+t.patient.prenomPatient),1)]),e("div",I,[t.ordonnance?(s(),i("table",N,[e("tr",null,[e("td",R,[(s(!0),i(p,null,g(t.ordonnance.medicaments,n=>(s(),i("div",{key:n.id},[e("h6",B,d(n.nomMedicament+" "+n.dosageMedicament+" "+n.uniteDosageMedicament),1),e("ul",null,[e("li",C,d(n.pivot.prescription),1)])]))),128))])])])):l("",!0)]),t.patient.RendezVous[0]&&new Date(t.patient.RendezVous[0].dateRendezVous)>new Date?(s(),i("div",F,[c(" RDV Prochain: "),e("span",T,d(t.patient.RendezVous[0].dateRendezVous),1)])):l("",!0)]),e("div",j,[y(f)]),e("div",L,[e("button",{style:{"font-size":"20px"},onClick:a[0]||(a[0]=n=>o.printInvoice()),type:"button",class:"btn btn-outline-primary mt-3"},[S,c("Imprimer ")])])])):l("",!0)],32)])])]))}});export{W as default};
