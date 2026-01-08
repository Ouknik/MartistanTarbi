<template>
    <div>
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between" style="background-color: #fae9dd">
                <div class="iq-header-title">
                    <h4 class="card-title">Rendez Vous</h4>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div ref="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";

export default {
    props: {
        rendezvous: Array,
    },
    methods: {
        renderCalendar() {
            const calendarElement = this.$refs.calendar;
            calendarElement.style.width = "100%";
            calendarElement.style.height = "500px";

            const calendar = new Calendar(calendarElement, {
                plugins: [dayGridPlugin, timeGridPlugin],
                defaultView: "timeGridWeek",
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay",
                },
                buttonText: {
                    today: "Aujourdhui",
                    week: "Semaine",
                    month: "Mois",
                },
                locale: "fr",
                firstDay: 1,
                events: this.rendezvous.map((appointment) => ({
                    title:
                        appointment.patient.nomPatient +
                        " " +
                        appointment.patient.prenomPatient,
                    start: appointment.dateRendezVous,
                })),
            });
            calendar.render();
        },
    },
    mounted() {
        this.renderCalendar();
    },
};
</script>

