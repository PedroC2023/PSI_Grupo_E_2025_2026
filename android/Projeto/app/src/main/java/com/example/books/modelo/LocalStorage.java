package com.example.books.modelo;

import android.content.Context;
import android.content.SharedPreferences;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import java.lang.reflect.Type;
import java.util.ArrayList;
import java.util.List;

public class LocalStorage {

    private static final String PREF_NAME = "APP_DATA";
    private static final String KEY_USERS = "USERS";
    private static final String KEY_EVENTS = "EVENTS";
    private static final String KEY_LOGGED_USER = "LOGGED_USER";

    private SharedPreferences prefs;
    private Gson gson = new Gson();

    public LocalStorage(Context ctx) {
        prefs = ctx.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
    }

    // ---------------- USERS ----------------

    public List<UserProfile> getUsers() {
        String json = prefs.getString(KEY_USERS, "");
        if (json.isEmpty()) return new ArrayList<>();

        Type type = new TypeToken<List<UserProfile>>(){}.getType();
        return gson.fromJson(json, type);
    }

    public void saveUsers(List<UserProfile> users) {
        prefs.edit().putString(KEY_USERS, gson.toJson(users)).apply();
    }

    public void addUser(UserProfile user) {
        List<UserProfile> users = getUsers();
        users.add(user);
        saveUsers(users);
    }

    public UserProfile login(String email, String password) {
        for (UserProfile u : getUsers()) {
            if (u.getEmail().equals(email) && u.getPassword().equals(password)) {
                prefs.edit().putString(KEY_LOGGED_USER, gson.toJson(u)).apply();
                return u;
            }
        }
        return null;
    }

    public UserProfile getLoggedUser() {
        String json = prefs.getString(KEY_LOGGED_USER, "");
        if (json.isEmpty()) return null;
        return gson.fromJson(json, UserProfile.class);
    }

    // ---------------- EVENTS ----------------

    public List<Event> getEvents() {
        String json = prefs.getString(KEY_EVENTS, "");
        if (json.isEmpty()) return new ArrayList<>();

        Type type = new TypeToken<List<Event>>(){}.getType();
        return gson.fromJson(json, type);
    }

    public void saveEvents(List<Event> events) {
        prefs.edit().putString(KEY_EVENTS, gson.toJson(events)).apply();
    }

    public void addEvent(Event e) {
        List<Event> events = getEvents();
        events.add(e);
        saveEvents(events);
    }
}
