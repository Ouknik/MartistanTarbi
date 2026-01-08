import"./print-b31df52a.js";import{_ as l}from"./_plugin-vue_export-helper-c27b6911.js";import{o as s,d as r,a as t,t as a,F as p,f as m,C as _,D as h}from"./app-e263ac0f.js";const u={props:{modelValue:Object},data(){return{formattedDate:"",sumDays:0,currentDate:""}},methods:{printInvoice(){this.$nextTick(()=>{let e=this.$refs.printableContent;if(e){let n=window.frames.print_frame;n.document.body.innerHTML=`
          <style>
            body {
              margin: 0;
              padding: 0;
            }
            .print-container {
              margin-top: 110px;
              padding: 10px;
            }
            .invoice-details {
              line-height: 1.9;
            }
            .invoice-details table td {
              text-align: center;
            }
            .invoice-details table td, .invoice-details table th {
              border: 1px solid black;
            }
            .headType{
              margin-top : 25px;
              margin-left:20px;
            }

            .headTypeNormal{
              margin-top : 25px;
            }

            
            .medicament{
              font-size:10px;
              
            }
            .ordonnance{
              margin-top:-15px;
            }

            .contentMedicament{
              margin-top:-200px;
            }

            .medicamentNormal{
              margin-bottom:35px;
            }
          </style>
          <div class="print-container">${e.innerHTML}</div>`,n.focus(),n.print()}else console.error("Element with ID 'printable-contentOR' not found.")})}},mounted(){const e=new Date,n=e.getDate(),o=e.getMonth()+1,d=e.getFullYear();this.currentDate=`${n<10?"0"+n:n}-${o<10?"0"+o:o}-${d}`}},f=e=>(_("data-v-30cb326b"),e=e(),h(),e),g={style:{width:"100%",border:"1px solid #089bab"},ref:"printableContent"},x={class:"header",style:{"text-align":"center"}},b={contenteditable:"true",style:{"font-size":"18px"}},y=f(()=>t("h1",{class:"ordonnance"},"Ordonnance",-1)),v={contenteditable:"true",class:"ordonnance mt-1",style:{"font-size":"18px"}},D={contenteditable:"true",style:{"font-size":"20px","font-family":"Verdana, Geneva, Tahoma, sans-serif",color:"black","margin-top":"40px","margin-left":"20px"},class:"contentMedicament"},w={class:"text-left font-weight-bold",style:{"margin-top":"-10px"}},T={style:{"margin-top":"-30px"},class:"medicament"},I={style:{"text-align":"left"}};function M(e,n,o,d,c,k){return s(),r("div",g,[t("div",x,[t("h4",b," Taroudant Le : "+a(c.currentDate)+" : تارودانت في ",1),y,t("h4",v,a(o.modelValue.dataord.patient.nomPatient+" "+o.modelValue.dataord.patient.prenomPatient),1)]),t("div",D,[t("div",null,[(s(!0),r(p,null,m(o.modelValue.dataord.traitementsChoisi,i=>(s(),r("div",{key:i.id,class:"medicamentNormal"},[t("h6",w,a(i.nomMedicament)+" "+a(i.dosageMedicament)+" "+a(i.uniteDosageMedicament),1),t("ul",T,[t("li",I,a(i.prescription),1)])]))),128))])])],512)}const z=l(u,[["render",M],["__scopeId","data-v-30cb326b"]]);export{z as default};
