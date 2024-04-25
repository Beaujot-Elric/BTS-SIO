package com.example.gremdic;

import android.content.Intent;
import android.os.Bundle;
import android.widget.EditText;
import android.widget.RadioButton;
import android.view.View;
import android.widget.RadioGroup;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

public class reunions extends AppCompatActivity {

    BD db;
    EditText dateR;
    EditText heureR;
    EditText salleR;
    RadioGroup typeR;
    String typeRBouton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reunions);

        dateR = findViewById(R.id.tbDateR);
        heureR = findViewById(R.id.tbHeureR);
        salleR = findViewById(R.id.tbSalleR);
        typeR = findViewById(R.id.radioGroupeR);

        db = new BD(this);

        // Ajoutez un écouteur pour détecter le changement de sélection dans le groupe de boutons radio
        typeR.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup group, int checkedId) {
                // checkedId est l'ID du bouton radio sélectionné
                switch (checkedId) {
                    case R.id.rbEquipe:
                        typeRBouton = "equipe";
                        break;
                    case R.id.rbResponsable:
                        typeRBouton = "responsable";
                        break;
                }
            }
        });
    }

    public void enregistrerReunion(View view) {
        if(dateR.getText().toString().isEmpty() || heureR.getText().toString().isEmpty() || salleR.getText().toString().isEmpty() || typeRBouton == null){
            Toast.makeText(this, "Veuillez remplir tous les champs", Toast.LENGTH_LONG).show();
            return;
        }

        try {
            //int leCp = Integer.parseInt(cp.getText().toString());
            db.insertReunion(dateR.getText().toString(), heureR.getText().toString(), Integer.parseInt(salleR.getText().toString()), typeRBouton);
            Intent enregistrerR = new Intent(this, Accueuil.class);
            startActivity(enregistrerR);
        } catch(Exception e){
            Toast.makeText(this, "Erreur lors de l'enregistrement : " + e.getMessage(), Toast.LENGTH_LONG).show();
            e.printStackTrace(); // Ajout d'un log pour voir l'erreur complète dans la console
        }
    }

    public void decoR(View view){
        Intent btnDisconnectR = new Intent(this, Connexion.class);
        startActivity(btnDisconnectR);
    }
}

