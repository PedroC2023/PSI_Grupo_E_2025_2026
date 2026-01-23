package com.example.books;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class MainActivity extends AppCompatActivity {

    private String email;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_main);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });

        TextView tvEmail=findViewById(R.id.tvEmail);
        Intent intent=getIntent();
        if(intent!=null){
            email=intent.getStringExtra("EMAIL");
            if(email!=null)
                tvEmail.setText(email);
        }
    }


    public void onClickEstatico(View view) {
        Intent intent=new Intent(this,DetalhesEstaticoActivity.class);
        startActivity(intent);
    }

    public void onClickDinamico(View view) {
        Intent intent=new Intent(this,DetalhesDinamicoActivity.class);
    }

    public void onClickEmail(View view) {

    }
}