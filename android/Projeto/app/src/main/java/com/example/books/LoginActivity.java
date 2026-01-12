package com.example.books;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class LoginActivity extends AppCompatActivity {

    private EditText etEmail, etPassword;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_login);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });
        setTitle("Login");
        etEmail=findViewById(R.id.etEmail);
        etPassword=findViewById(R.id.etPassword);
    }

    public void onClickLogin(View view) {
        String email=etEmail.getText().toString();
        String pass=etPassword.getText().toString();

        if(!isEmailValid(email)){
            etEmail.setError("Email inválido");
            return;
        }
        if(!isPasswordValid(pass)){
            etPassword.setError("Pass inválido");
            return;
        }
        //Toast.makeText(this,"",Toast.LENGTH_LONG).show();
        Intent intent=new Intent(this,MenuMainActivity.class);
        intent.putExtra("EMAIL",email);
        startActivity(intent);
        finish();
    }
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