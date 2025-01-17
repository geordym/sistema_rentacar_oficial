document.addEventListener("DOMContentLoaded", (function () {
    var e = new bootstrap.Modal(document.getElementById("e-modal"), {keyboard: !1}),
        t = document.getElementById("codex-events-list"),
        l = (document.getElementById("e-title"), document.getElementById("form-event")), n = null,
        a = document.getElementsByClassName("needs-validation");
    n = null;
    new FullCalendar.Draggable(t, {
        itemSelector: ".fc-event", eventData: function (e) {
            return {title: e.innerText.trim(), className: e.className}
        }
    });
    var d = document.getElementById("codex-calendar"), o = new FullCalendar.Calendar(d, {
        codexEvntFilter: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listYear"
        },
        initialDate: "2022-01-12",
        navLinks: !0,
        editable: !0,
        droppable: !0,
        selectable: !0,
        selectMirror: !0,
        nowIndicator: !0,
        dayMaxEvents: !0,
        drop: function (e) {
            document.getElementById("drop-remove").checked && e.draggedEl.parentNode.removeChild(e.draggedEl)
        },
        select: function (e) {
            n = null, $("#e-title").val("");
            var t = e.start, l = e.allDay;
            $("#startdate").val(t), $("#allDay").val(l), $("#btn-delete-event").hide(), $("#e-modal").modal("show"), $("#modal-title").html("Add Event"), o.unselect()
        },
        eventClick: function (e) {
            document.getElementById("e-title").value[0] = "", n = e.event, document.getElementById("e-title").value = n.title, $("#modal-title").html("Edit Event"), $("#btn-delete-event").show(), $("#e-modal").modal("show")
        },
        events: [{title: "All Day Event", start: "2022-02-01"}, {
            title: "Long Event",
            start: "2022-03-07",
            end: "2022-03-10"
        }, {groupId: 999, title: "metting", start: "2022-01-09T16:00:00"}]
    });
    l.addEventListener("submit", (function (t) {
        t.preventDefault();
        var l, d = $("#startdate").val(), i = $("#allDay").val(), r = document.getElementById("e-title").value;
        console.log(n), !1 === a[0].checkValidity() ? a[0].classList.add("was-validated") : (n ? (n.setProp("title", r), n.setProp()) : (l = {
            title: r,
            start: new Date(d),
            allDay: i
        }, o.addEvent(l)), e.hide())
    })), $("#btn-delete-event").click((function () {
        n && (n.remove(), e.hide())
    })), o.render()
}));
