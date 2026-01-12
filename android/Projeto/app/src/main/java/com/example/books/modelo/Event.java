package com.example.books.modelo;

public class Event {
    private String id;
    private String title;
    private String type;
    private String location;
    private String startDate;
    private String endDate;
    private String createdBy; // COLABORADOR ID

    public Event() {}

    public Event(String title, String type, String location,
                 String startDate, String endDate) {
        this.title = title;
        this.type = type;
        this.location = location;
        this.startDate = startDate;
        this.endDate = endDate;
    }

    public String getTitle() { return title; }
    public String getType() { return type; }
}

