<template>
    <div ref="calendar"></div>
</template>

<script setup>
import { onMounted, ref, computed } from "vue";

const props = defineProps({
    rendezvous: Object,
});
let rendezVousData = ref(props.rendezvous);

onMounted(() => {
    rendezVousData.value = props.rendezvous;
    window.Echo.channel('calendar-doctor').listen('CalendarDoctor',(e)=>{
        rendezVousData.value=e.calendarDoctor;
    });
});

</script>

<script>
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';

export default {
    data() {
        return {
            patients: [],
        };
    },
    computed:
    {
        combinedEvents() {
            const patientsEvents = this.rendezvous.map(rendezvous => ({
                id: rendezvous.patient.id,
                title: rendezvous.patient.nomPatient + " " + rendezvous.patient.prenomPatient,
                start: rendezvous.dateRendezVous,
                color: rendezvous.docteur.id == 1 ? '#a6a6a6' : '#01c1cc',
                textColor: '#000000',
                dateNaissance: rendezvous.patient.dateNaissancePatient,
                age: rendezvous.patient.age,
                numeroCarte: rendezvous.patient.cinPatient,
                docteur: rendezvous.docteur.name,
                type: 'patient',
            }));

            const docteursEvents = this.rendezvous.reduce((docteurEvents, rendezvous) => {
                const docteurId = rendezvous.docteur.id;
                const rendezvousDate = new Date(rendezvous.dateRendezVous).toLocaleDateString(); // Obtenez la date sous forme de chaîne sans l'heure
                if (!docteurEvents[docteurId]) {
                    docteurEvents[docteurId] = {};
                }
                if (!docteurEvents[docteurId][rendezvousDate]) {
                    docteurEvents[docteurId][rendezvousDate] = {
                        id: docteurId,
                        title: `${rendezvous.docteur.name}` + `</br>` + `  (1 Rendez-Vous)`, // Initialisez le titre ici
                        start: rendezvous.dateRendezVous,
                        color: docteurId == 1 ? '#91BBF2' : '#0367A6',
                        textColor: '#000000',
                        type: 'docteur',
                        count: 1,
                    };
                } else {
                    docteurEvents[docteurId][rendezvousDate].count++;
                    docteurEvents[docteurId][rendezvousDate].title = `${rendezvous.docteur.name}` + `</br>` + ` (${docteurEvents[docteurId][rendezvousDate].count} Rendez-Vous)`;
                }


                return docteurEvents;
            }, {});


            const docteursEventsArray = [];
            for (const docteurId in docteursEvents) {
                const docteurDates = Object.values(docteursEvents[docteurId]);
                docteursEventsArray.push(...docteurDates);
            }


            return [...docteursEventsArray, ...patientsEvents];
        },
    },
    methods: {

        renderCalendar() {
            let calendarElement = this.$refs.calendar;
            calendarElement.style.width = '100%';
            calendarElement.style.height = '300px';
            calendarElement.parentElement.style.display = 'flex';
            calendarElement.parentElement.style.alignItems = 'center';
            calendarElement.parentElement.style.justifyContent = 'center';

            const sortedEvents = this.combinedEvents.slice().sort((a, b) => {
                if (a.type === 'docteur' && b.type !== 'docteur') {
                    return -1; 
                } else if (a.type !== 'docteur' && b.type === 'docteur') {
                    return 1;
                } else {
                    return 0;
                }
            });


            let calendar = new Calendar(this.$refs.calendar, {
                plugins: [dayGridPlugin],
                headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'next,today',

                },
                buttonText: {
                    today: 'Aujourdhui',
                    day: 'Jour',
                    month: 'Mois',
                },
                locale: "fr",
                firstDay: 1,
                events: sortedEvents, 

                dayMaxEvents: 2,
                views: {
                    timeGrid: {
                        dayMaxEventRows: 2
                    }
                },
                eventContent: function (arg) {
                    let patientId = arg.event.id;
                    let eventHtml = `<a href="/patients/${patientId}" class="text-white" style="font-size: 14px">${arg.event.title}</a>`;

                    if (arg.event.type === 'docteur') {
                        eventHtml += `</br><p style="font-size: 12px;">Docteur: ${arg.event.title}</p>`;

                        eventHtml += `</br><p style="font-size: 12px;">${arg.event.count} </p>`;
                    }

                    return {
                        html: eventHtml,
                    };
                },
                moreLinkClick: function (arg) {
                    if (arg.view.type === 'timeGridWeek' || arg.view.type === 'timeGridDay') {
                        arg.jsEvent.preventDefault();
                        this.changeView('timeGridDay', arg.date);
                    }
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
