package com.example.books;

import android.content.Intent;
import android.os.Bundle;
import android.widget.*;
import androidx.appcompat.app.AppCompatActivity;

import com.example.books.modelo.LocalStorage;
import com.example.books.modelo.UserProfile;

public class LoginActivity extends AppCompatActivity {

    private EditText etEmail, etPassword;
    private Button btnLogin;
    private LocalStorage storage;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        storage = new LocalStorage(this);


        etEmail = findViewById(R.id.etEmail);
        etPassword = findViewById(R.id.etPassword);
        btnLogin = findViewById(R.id.btnlogin);

        btnLogin.setOnClickListener(v -> doLogin());
    }

    private void doLogin() {
        String email = etEmail.getText().toString().trim();
        String pass = etPassword.getText().toString().trim();

        UserProfile user = storage.login(email, pass);

        if (user == null) {
            Toast.makeText(this, "Credenciais inválidas", Toast.LENGTH_SHORT).show();
            return;
        }

        startActivity(new Intent(this, MenuMainActivity.class));
        finish();
    }
}
