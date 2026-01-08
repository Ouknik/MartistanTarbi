import{o,d as r,a as t,h as l,b as d,t as m,g as c,e as u}from"./app-e263ac0f.js";import{H as p,F as h}from"./FooterDocteur-aa572583.js";import"./_plugin-vue_export-helper-c27b6911.js";const f={class:"modal fade bd-certificatview-modal-lg",tabindex:"-1",role:"dialog",style:{display:"none"},id:"viewCertificat","aria-hidden":"true"},_={class:"modal-dialog modal-lg"},y={class:"modal-content"},b=t("div",{class:"modal-header bg-secondary"},[t("h4",{class:"modal-title text-white"},"Certificat Médicale "),t("button",{type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},[t("span",{"aria-hidden":"true"},"×")])],-1),g={class:"modal-body"},v={key:0,id:"printable-contentCertificat"},C={class:"header",style:{"text-align":"center"}},w={style:{"font-size":"15px"}},x=t("h2",{class:"mt-2"},"CERTIFICAT MEDICAL",-1),D={key:0,class:"invoice-details",style:{"font-size":"17px","font-family":"Verdana, Geneva, Tahoma, sans-serif",color:"black","text-align":"justify"}},T=["innerHTML"],M={class:"footer-cer"},j={class:"text-right"},V=t("i",{class:"ri-printer-line"},null,-1),k={props:{patient:Object,age:Number,user:Object,docteur:Object,certificat:Object},methods:{printContent(){let i=document.getElementById("printable-contentCertificat").innerHTML,e=window.frames.print_frame;e.document.body.innerHTML=`
            <style>
                body {
                    margin: 0;
                    padding: 0;
                }
                .print-container {
                    margin-top: 100px;
                    padding:30px;
                }
                .invoice-details {
                    line-height: 2; /* Adjust this value to change the line spacing */
                }
            </style>
            <div class="print-container">`+i+"</div>",e.focus(),e.print()}},data(){return{sumDays:0,currentDate:""}},mounted(){const i=new Date,e=i.getDate(),n=i.getMonth()+1,a=i.getFullYear();this.currentDate=`${e<10?"0"+e:e}-${n<10?"0"+n:n}-${a}`;let s=document.createElement("iframe");s.name="print_frame",s.width="0",s.height="0",s.style.display="none",document.body.appendChild(s)}},I=Object.assign(k,{__name:"ViewCertificat",setup(i){return(e,n)=>(o(),r("div",f,[t("div",_,[t("div",y,[t("form",{onSubmit:n[1]||(n[1]=l((...a)=>e.submit&&e.submit(...a),["prevent"]))},[b,t("div",g,[d(p,{style:{"margin-bottom":"10px"}}),i.certificat?(o(),r("div",v,[t("div",C,[t("h4",w," Taroudant Le : "+m(i.certificat.dateCertificat)+" : تارودانت في ",1),x]),i.certificat?(o(),r("div",D,[t("div",{innerHTML:i.certificat.contenu},null,8,T)])):c("",!0)])):c("",!0),t("div",M,[d(h)]),t("div",j,[t("button",{onClick:n[0]||(n[0]=(...a)=>e.printContent&&e.printContent(...a)),style:{"font-size":"20px"},type:"button",class:"btn btn-outline-primary mt-3"},[V,u("Imprimer ")])])])],32)])])]))}});export{I as default};
