package com.example.books;

import android.app.DatePickerDialog;
import android.app.TimePickerDialog;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.TimePicker;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.firestore.FirebaseFirestore;

import java.util.Calendar;
import java.util.HashMap;
import java.util.Map;

public class CreateEventActivity extends AppCompatActivity {

    private TextView tvStartDate, tvStartTime, tvEndDate, tvEndTime;
    private EditText etTitle, etLocation, etDescription, etCapacity;
    private Spinner spinnerType;
    private Button btnSave;

    private long startTimestamp = 0L;
    private long endTimestamp = 0L;

    private FirebaseFirestore db;
    private String currentUid;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_create_event);

        db = FirebaseFirestore.getInstance();
        currentUid = FirebaseAuth.getInstance().getCurrentUser() != null ?
                FirebaseAuth.getInstance().getCurrentUser().getUid() : null;

        etTitle = findViewById(R.id.etEventTitle);
        etLocation = findViewById(R.id.etEventLocation);
        etDescription = findViewById(R.id.etEventDescription);
        etCapacity = findViewById(R.id.etEventCapacity);

        tvStartDate = findViewById(R.id.tvStartDate);
        tvStartTime = findViewById(R.id.tvStartTime);
        tvEndDate = findViewById(R.id.tvEndDate);
        tvEndTime = findViewById(R.id.tvEndTime);

        spinnerType = findViewById(R.id.spinnerEventType);
        btnSave = findViewById(R.id.btnSaveEvent);

        // Spinner tipos de evento
        String[] tipos = new String[]{"Consulta", "Workshop", "Palestra", "Exame", "Outro"};
        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_item, tipos);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinnerType.setAdapter(adapter);

        tvStartDate.setOnClickListener(v -> pickDate(true));
        tvStartTime.setOnClickListener(v -> pickTime(true));
        tvEndDate.setOnClickListener(v -> pickDate(false));
        tvEndTime.setOnClickListener(v -> pickTime(false));

        btnSave.setOnClickListener(v -> saveEvent());
    }

    private void pickDate(boolean isStart) {
        final Calendar c = Calendar.getInstance();
        DatePickerDialog dpd = new DatePickerDialog(this, (view, year, month, dayOfMonth) -> {
            String dateText = String.format("%02d/%02d/%04d", dayOfMonth, month + 1, year);
            if (isStart) tvStartDate.setText(dateText);
            else tvEndDate.setText(dateText);

            // atualiza timestamp parcial (mantém hora se já escolhida)
            Calendar cal = Calendar.getInstance();
            if (isStart && startTimestamp != 0L) cal.setTimeInMillis(startTimestamp);
            if (!isStart && endTimestamp != 0L) cal.setTimeInMillis(endTimestamp);
            cal.set(Calendar.YEAR, year);
            cal.set(Calendar.MONTH, month);
            cal.set(Calendar.DAY_OF_MONTH, dayOfMonth);
            if (isStart) startTimestamp = cal.getTimeInMillis(); else endTimestamp = cal.getTimeInMillis();
        }, c.get(Calendar.YEAR), c.get(Calendar.MONTH), c.get(Calendar.DAY_OF_MONTH));
        dpd.show();
    }

    private void pickTime(boolean isStart) {
        final Calendar c = Calendar.getInstance();
        TimePickerDialog tpd = new TimePickerDialog(this, (TimePicker view, int hourOfDay, int minute) -> {
            String timeText = String.format("%02d:%02d", hourOfDay, minute);
            if (isStart) tvStartTime.setText(timeText);
            else tvEndTime.setText(timeText);

            Calendar cal = Calendar.getInstance();
            if (isStart && startTimestamp != 0L) cal.setTimeInMillis(startTimestamp);
            if (!isStart && endTimestamp != 0L) cal.setTimeInMillis(endTimestamp);
            cal.set(Calendar.HOUR_OF_DAY, hourOfDay);
            cal.set(Calendar.MINUTE, minute);
            cal.set(Calendar.SECOND, 0);
            if (isStart) startTimestamp = cal.getTimeInMillis(); else endTimestamp = cal.getTimeInMillis();
        }, c.get(Calendar.HOUR_OF_DAY), c.get(Calendar.MINUTE), true);
        tpd.show();
    }

    private void saveEvent() {
        String title = etTitle.getText().toString().trim();
        String location = etLocation.getText().toString().trim();
        String description = etDescription.getText().toString().trim();
        String capacityStr = etCapacity.getText().toString().trim();
        String type = spinnerType.getSelectedItem().toString();

        if (TextUtils.isEmpty(title) || startTimestamp == 0L || endTimestamp == 0L || TextUtils.isEmpty(location)) {
            Toast.makeText(this, "Preenche título, datas e local", Toast.LENGTH_SHORT).show();
            return;
        }

        if (startTimestamp >= endTimestamp) {
            Toast.makeText(this, "Data inicial deve ser antes da data final", Toast.LENGTH_SHORT).show();
            return;
        }

        int capacity = 0;
        try {
            capacity = Integer.parseInt(capacityStr);
        } catch (NumberFormatException e) {
            capacity = 0;
        }

        Map<String, Object> event = new HashMap<>();
        event.put("title", title);
        event.put("description", description);
        event.put("startTimestamp", startTimestamp);
        event.put("endTimestamp", endTimestamp);
        event.put("location", location);
        event.put("type", type);
        event.put("capacity", capacity);
        event.put("createdBy", currentUid != null ? currentUid : "unknown");

        // grava no Firestore
        db.collection("events").add(event).addOnSuccessListener(docRef -> {
            Toast.makeText(this, "Evento criado", Toast.LENGTH_SHORT).show();
            finish();
        }).addOnFailureListener(e -> {
            Toast.makeText(this, "Erro ao criar evento: " + e.getMessage(), Toast.LENGTH_LONG).show();
        });
    }
}
