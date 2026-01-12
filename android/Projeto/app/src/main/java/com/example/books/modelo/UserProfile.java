package com.example.books.modelo;

public class UserProfile {
    private String uid;
    private String name;
    private String email;
    private String role; // PACIENTE | COLABORADOR

    public UserProfile() {}

    public UserProfile(String uid, String name, String email) {
        this.uid = uid;
        this.name = name;
        this.email = email;
        this.role = "PACIENTE"; // 👈 AUTOMÁTICO
    }

    public String getRole() {
        return role;
    }
}
