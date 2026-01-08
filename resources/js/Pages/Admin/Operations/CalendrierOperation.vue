<template>
    <div class="row">
        <div class="col-lg-12 p-4">
            <div ref="calendar"></div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    operationsPatient: Object,
});
</script>
<script>
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid'; // Import the plugin

export default {
    data() {
        return {
            // patients: [],
        };
    },
    methods: {
        renderCalendar() {
            let calendarElement = this.$refs.calendar;
            calendarElement.style.width = '80%';
            calendarElement.style.height = '300px';
            calendarElement.parentElement.style.display = 'flex';
            calendarElement.parentElement.style.alignItems = 'center';
            calendarElement.parentElement.style.justifyContent = 'center';
            let calendar = new Calendar(this.$refs.calendar, {
                eventColor:'#17a2b8',
                plugins: [dayGridPlugin, timeGridPlugin],
                // defaultView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Aujourdhui',
                    day: 'Jour',
                    week: 'Semaine',
                    month: 'Mois',
                },
                locale: "fr",
                firstDay: 1,
                events: this.operationsPatient
                    .filter(
                        (operationsPatient) =>
                            operationsPatient.etatOperation === 'Programmer' ||
                            operationsPatient.etatOperation === 'Reporter'
                    )
                    .map((operationsPatient) => ({
                        id: operationsPatient.patient.id,
                        title: `<span class="text-dark ml-4 font-size-16">${operationsPatient.patient.nomPatient} ${operationsPatient.patient.prenomPatient}</br>${operationsPatient.nomOperation}</br>${operationsPatient.clinique.nomClinique}</br>Prix: ${operationsPatient.prixOperation} DH</span>`,
                        start: operationsPatient.dateOperation,
                    })),
                dayMaxEvents: 1,
                views: {
                    timeGrid: {
                        dayMaxEventRows: 1
                    }
                },
                eventContent: function (arg) {
                    let patientId = arg.event.id;
                    return {
                        html: `<a href="/patients/${patientId}" class="text-white ">${arg.event.title}</a>`
                    };
                },
                
                
            });
            calendar.render();
        },
    },
    mounted() {
        this.renderCalendar();
    },
};
</script>
