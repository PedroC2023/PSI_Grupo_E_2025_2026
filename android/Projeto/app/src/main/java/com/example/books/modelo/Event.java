package com.example.books.modelo;

public class Event {

    private String id;
    private String title;
    private String description;
    private long startTimestamp;
    private long endTimestamp;
    private String location;
    private String type;
    private int capacity;
    private String createdBy;

    public Event() {}

    public Event(String id, String title, String description, long startTimestamp,
                 long endTimestamp, String location, String type, int capacity, String createdBy) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.startTimestamp = startTimestamp;
        this.endTimestamp = endTimestamp;
        this.location = location;
        this.type = type;
        this.capacity = capacity;
        this.createdBy = createdBy;
    }

    public String getId() { return id; }
    public String getTitle() { return title; }
    public String getDescription() { return description; }
    public long getStartTimestamp() { return startTimestamp; }
    public long getEndTimestamp() { return endTimestamp; }
    public String getLocation() { return location; }
    public String getType() { return type; }
    public int getCapacity() { return capacity; }
    public String getCreatedBy() { return createdBy; }
}
