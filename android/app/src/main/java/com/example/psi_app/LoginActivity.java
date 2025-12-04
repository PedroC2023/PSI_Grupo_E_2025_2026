package com.example.psi_app;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class LoginActivity extends AppCompatActivity {

    EditText txtEmail, txtPassword;
    Button btnLogin;
    TextView linkSignup;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        txtEmail = findViewById(R.id.txtEmail);
        txtPassword = findViewById(R.id.txtPassword);
        btnLogin = findViewById(R.id.btnLogin);
        linkSignup = findViewById(R.id.linkSignup);

        // Ir para Signup
        linkSignup.setOnClickListener(v -> {
            Intent i = new Intent(this, SignupActivity.class);
            startActivity(i);
        });

        // Login fake
        btnLogin.setOnClickListener(v -> {
            String email = txtEmail.getText().toString();
            String pass = txtPassword.getText().toString();

            Toast.makeText(this, "Botão clicado!", Toast.LENGTH_SHORT).show();



            if(email.trim().equalsIgnoreCase("admin@admin.com") && pass.equals("admin")) {

                SharedPreferences prefs = getSharedPreferences("AMSI_APP", MODE_PRIVATE);
                prefs.edit().putString("email", email).apply();

                Intent i = new Intent(this, MainActivity.class);
                startActivity(i);
                finish();
            }

        });
    }
    /*
    public void onClickLogin(View view) {
        String email=txtEmail.getText().toString();
        String pass=txtPassword.getText().toString();

        if(!isEmailValid(email)){
            txtEmail.setError("Pass inválida");
            return;
        }
        if(!isPasswordValid(pass)){
            txtPassword.setError("Email inválido");
            return;
        }
        //Toast.makeText(this,"",Toast.LENGTH_LONG).show();
        /*
        Intent intent=new Intent(this,MenuMainActivity.class);
        intent.putExtra("EMAIL",email);
        startActivity(intent);

    }*/
    private boolean isEmailValid(String email){
        if(email==null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }
    private boolean isPasswordValid(String pass){
        if(pass==null)
            return false;
        return pass.length()>4;
    }
}

