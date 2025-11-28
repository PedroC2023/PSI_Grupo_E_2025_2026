package com.example.psi_app;

import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class SignupActivity extends AppCompatActivity {

    EditText txtName, txtEmail, txtPass1, txtPass2;
    Button btnSignup;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

        txtName = findViewById(R.id.txtName);
        txtEmail = findViewById(R.id.txtEmail);
        txtPass1 = findViewById(R.id.txtPassword);
        txtPass2 = findViewById(R.id.txtPasswordConfirm);
        btnSignup = findViewById(R.id.btnSignup);

        btnSignup.setOnClickListener(v -> {
            if(!txtPass1.getText().toString().equals(txtPass2.getText().toString())) {
                Toast.makeText(this, "As passwords não coincidem!", Toast.LENGTH_SHORT).show();
                return;
            }

            // FUTURO: Aqui irás enviar dados para API real
            Toast.makeText(this, "Registo concluído!", Toast.LENGTH_SHORT).show();
            finish();
        });
    }
}

