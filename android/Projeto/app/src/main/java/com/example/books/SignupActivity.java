package com.example.books;

import android.os.Bundle;
import android.widget.*;
import androidx.appcompat.app.AppCompatActivity;

import com.example.books.modelo.LocalStorage;
import com.example.books.modelo.UserProfile;

import java.util.UUID;

public class SignupActivity extends AppCompatActivity {

    private EditText etName, etEmail, etPassword;
    private Button btnSignup;
    private LocalStorage storage;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

        storage = new LocalStorage(this);

        etName = findViewById(R.id.etNameSignup);
        etEmail = findViewById(R.id.etEmailSignup);
        etPassword = findViewById(R.id.etPasswordSignup);
        btnSignup = findViewById(R.id.btnSignup);

        btnSignup.setOnClickListener(v -> doSignup());
    }

    private void doSignup() {
        String name = etName.getText().toString().trim();
        String email = etEmail.getText().toString().trim();
        String pass = etPassword.getText().toString().trim();

        if (name.isEmpty() || email.isEmpty() || pass.isEmpty()) {
            Toast.makeText(this, "Preenche todos os campos", Toast.LENGTH_SHORT).show();
            return;
        }

        String uid = UUID.randomUUID().toString();

        UserProfile user = new UserProfile(uid, name, email, pass);

        storage.addUser(user);

        Toast.makeText(this, "Conta criada!", Toast.LENGTH_SHORT).show();
        finish();
    }
}
