package utils;

import com.example.books.modelo.UserProfile;

public class SessionManager {

    private static UserProfile currentUser;

    public static void setUser(UserProfile user) {
        currentUser = user;
    }

    public static boolean isColaborador() {
        return currentUser != null &&
                "COLABORADOR".equals(currentUser.getRole());
    }

    public static boolean isPaciente() {
        return currentUser != null &&
                "PACIENTE".equals(currentUser.getRole());
    }
}

