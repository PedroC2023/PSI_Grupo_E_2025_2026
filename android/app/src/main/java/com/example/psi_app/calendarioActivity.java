package com.example.psi_app;

import android.os.Bundle;
import android.widget.CalendarView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

public class calendarioActivity extends AppCompatActivity{

    CalendarView calendarView;
    TextView tvDataSelecionada;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.calendario_main);

        // 1. Encontrar os componentes pelo ID
        calendarView = findViewById(R.id.calendarView);
        tvDataSelecionada = findViewById(R.id.tvDataSelecionada);

        // 2. Adicionar o ouvinte de eventos (Listener) para mudanças de data
        calendarView.setOnDateChangeListener(new CalendarView.OnDateChangeListener() {
            @Override
            public void onSelectedDayChange(@NonNull CalendarView view, int year, int month, int dayOfMonth) {
                // Nota: O mês começa em 0 (Janeiro = 0, Dezembro = 11), então somamos +1
                String data = dayOfMonth + "/" + (month + 1) + "/" + year;

                //Atualizar o texto na tela
                tvDataSelecionada.setText("Data: " + data);

                //Mostrar um pequeno aviso (Toast)
                Toast.makeText(calendarioActivity.this, "Você clicou em: " + data, Toast.LENGTH_SHORT).show();


            }
        });
    }
}
