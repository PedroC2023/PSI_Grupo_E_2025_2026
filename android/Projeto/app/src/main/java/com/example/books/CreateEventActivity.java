package com.example.books;

import android.app.DatePickerDialog;
import android.app.TimePickerDialog;
import android.os.Bundle;
import android.text.TextUtils;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.example.books.modelo.Event;
import com.example.books.modelo.LocalStorage;
import com.example.books.modelo.UserProfile;

import java.util.Calendar;
import java.util.UUID;

public class CreateEventActivity extends AppCompatActivity {

    private TextView tvStartDate, tvStartTime, tvEndDate, tvEndTime;
    private EditText etTitle, etLocation, etDescription, etCapacity;
    private Spinner spinnerType;
    private Button btnSave;

    private long startTimestamp = 0L;
    private long endTimestamp = 0L;

    private LocalStorage storage;
    private UserProfile currentUser;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_create_event);

        storage = new LocalStorage(this);
        currentUser = storage.getLoggedUser();

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

            Calendar cal = Calendar.getInstance();
            cal.setTimeInMillis(isStart ? startTimestamp : endTimestamp);
            cal.set(Calendar.YEAR, year);
            cal.set(Calendar.MONTH, month);
            cal.set(Calendar.DAY_OF_MONTH, dayOfMonth);

            if (isStart) startTimestamp = cal.getTimeInMillis();
            else endTimestamp = cal.getTimeInMillis();
        }, c.get(Calendar.YEAR), c.get(Calendar.MONTH), c.get(Calendar.DAY_OF_MONTH));
        dpd.show();
    }

    private void pickTime(boolean isStart) {
        final Calendar c = Calendar.getInstance();
        TimePickerDialog tpd = new TimePickerDialog(this, (view, hourOfDay, minute) -> {
            String timeText = String.format("%02d:%02d", hourOfDay, minute);
            if (isStart) tvStartTime.setText(timeText);
            else tvEndTime.setText(timeText);

            Calendar cal = Calendar.getInstance();
            cal.setTimeInMillis(isStart ? startTimestamp : endTimestamp);
            cal.set(Calendar.HOUR_OF_DAY, hourOfDay);
            cal.set(Calendar.MINUTE, minute);
            cal.set(Calendar.SECOND, 0);

            if (isStart) startTimestamp = cal.getTimeInMillis();
            else endTimestamp = cal.getTimeInMillis();
        }, c.get(Calendar.HOUR_OF_DAY), c.get(Calendar.MINUTE), true);
        tpd.show();
    }

    private void saveEvent() {
        String title = etTitle.getText().toString().trim();
        String location = etLocation.getText().toString().trim();
        String description = etDescription.getText().toString().trim();
        String capacityStr = etCapacity.getText().toString().trim();
        String type = spinnerType.getSelectedItem().toString();

        if (TextUtils.isEmpty(title) || TextUtils.isEmpty(location) ||
                startTimestamp == 0L || endTimestamp == 0L) {
            Toast.makeText(this, "Preenche todos os campos", Toast.LENGTH_SHORT).show();
            return;
        }

        if (startTimestamp >= endTimestamp) {
            Toast.makeText(this, "A data inicial deve ser antes da final", Toast.LENGTH_SHORT).show();
            return;
        }

        int capacity;
        try {
            capacity = Integer.parseInt(capacityStr);
        } catch (Exception e) {
            capacity = 0;
        }

        String eventId = UUID.randomUUID().toString();

        Event event = new Event(
                eventId,
                title,
                description,
                startTimestamp,
                endTimestamp,
                location,
                type,
                capacity,
                currentUser != null ? currentUser.getUid() : "unknown"
        );

        storage.addEvent(event);

        Toast.makeText(this, "Evento criado com sucesso!", Toast.LENGTH_SHORT).show();
        finish();
    }
}
