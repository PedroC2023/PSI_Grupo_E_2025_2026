package com.example.psi_app;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {

    TextView txtWelcome;
    Button btnLogout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        txtWelcome = findViewById(R.id.txtWelcome);
        btnLogout = findViewById(R.id.btnLogout);

        // Ler email guardado na sessão (login fake)
        SharedPreferences prefs = getSharedPreferences("AMSI_APP", MODE_PRIVATE);
        String email = prefs.getString("email", null);

        // Se não existe email → não está autenticado → voltar ao login
        if (email == null) {
            Intent i = new Intent(this, LoginActivity.class);
            startActivity(i);
            finish();
            return;
        }

        // Mostrar mensagem
        txtWelcome.setText("Bem-vindo, " + email + "!");

        // LOGOUT
        btnLogout.setOnClickListener(v -> {
            prefs.edit().clear().apply();  // apaga sessão
            Intent i = new Intent(this, LoginActivity.class);
            startActivity(i);
            finish();
        });
    }
}
