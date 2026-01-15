package com.example.books;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import com.google.android.material.navigation.NavigationView;

import org.w3c.dom.Text;

public class MenuMainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {
    public static final int ADD = 1;
    public static final int EDIT = 2;
    private DrawerLayout drawer;
    private NavigationView navigationView;

    private String email;
    private FragmentManager fragmentManager;


    private void carregarCabecalho() {
        email = getIntent().getStringExtra("EMAIL");

        //1A- se recebeu email=> armazena na sharedPref
        //1B- caso contrário => vai carregar o que existe no sharedPref

        SharedPreferences sharedPrefUser= getSharedPreferences("DADOS_USER", Context.MODE_PRIVATE);
        if(email!=null)
        {
            SharedPreferences.Editor editor=sharedPrefUser.edit();
            editor.putString("EMAIL",email);
            editor.apply();
        }
        else
            email=sharedPrefUser.getString("EMAIL","sem email");

        View hView = navigationView.getHeaderView(0);
        TextView tvEmail = hView.findViewById(R.id.tvEmail);
        tvEmail.setText(email);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu_main);

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        drawer = findViewById(R.id.drawerLayout);
        navigationView = findViewById(R.id.navView);
        navigationView.setNavigationItemSelectedListener(this);

        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar,
                R.string.ndOpen, R.string.ndClose);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        fragmentManager = getSupportFragmentManager();

        carregarFragmentoInicial();
        carregarCabecalho();
    }



    private boolean carregarFragmentoInicial() {
        Menu menu = navigationView.getMenu();
        MenuItem item = menu.getItem(0);
        item.setChecked(true);
        return onNavigationItemSelected(item);

        /*
        navigationView.setCheckedItem(R.id.navEstatico);
        fragmentManager.beginTransaction()
                .replace(R.id.contentFragment, new EstaticoFragment())
                .commit();
        setTitle("Livro Estático");*/
    }

    /*
    private void onClickNavigationItemSelected(MenuItem item) {

    }*/

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {
        Fragment fragment = null;
        int id = menuItem.getItemId();

        if (id == R.id.navEstatico) {
            fragment = new ListaLivrosFragment();
            setTitle(menuItem.getTitle());

        } else if (id == R.id.navDinamico) {
            fragment = new GrelhaLivrosFragment();
            setTitle(menuItem.getTitle());

        } else if (id == R.id.navEmail) {
            enviarEmail();
            /*
            Intent intent = new Intent(Intent.ACTION_SEND);
            intent.setType("message/rfc822");
            intent.putExtra(Intent.EXTRA_EMAIL, new String[]{"alguem@exemplo.com"});
            intent.putExtra(Intent.EXTRA_SUBJECT, "Livros");
            startActivity(Intent.createChooser(intent, "Enviar email..."));*/
        }

        if (fragment != null) {
            fragmentManager.beginTransaction()
                    .replace(R.id.contentFragment, fragment)
                    .commit();
        }

        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    private void enviarEmail() {
    }
}
