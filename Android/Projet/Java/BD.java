package com.example.gremdic;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class BD extends SQLiteOpenHelper {

    // Nom de la base de données
    private static final String NOM_BD = "Gère'Médic";
    // Version de la base de données
    private static final int VERSION_BD = 1;

    // Nom des tables
    private static final String TABLE_PROFESSIONNEL = "Professionnel";
    private static final String TABLE_RDV = "RDV";
    private static final String TABLE_REUNION = "Reunion";

    // Colonnes de la table Professionnel
    private static final String COL_ID_PRO = "Id_Professionnel";
    private static final String COL_NOM = "nom";
    private static final String COL_PRENOM = "prenom";
    private static final String COL_TYPE = "type";
    private static final String COL_ADRESSE = "adresse";
    private static final String COL_CP = "codePostal";
    private static final String COL_TEL = "tel";
    private static final String COL_MAIL = "mail";

    // Colonnes de la table RDV
    private static final String COL_ID_RDV = "Id_RDV";
    private static final String COL_DATE = "laDate";
    private static final String COL_HEURE = "heure";
    private static final String COL_MOTIF = "motif";
    private static final String COL_ID_PRO_FK = "Id_Professionnel";

    // Colonnes de la table Reunion
    private static final String COL_ID_REUNION = "Id_reunion";
    private static final String COL_DATE_R = "laDateR";
    private static final String COL_HEURE_R = "heureR";
    private static final String COL_SALLE_R = "SalleR";
    private static final String COL_TYPE_R = "typeR";

    public BD(Context context) {
        super(context, NOM_BD, null, VERSION_BD);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        // Création de la table Professionnel
        String CREATE_TABLE_PROFESSIONNEL = "CREATE TABLE " + TABLE_PROFESSIONNEL + "("
                + COL_ID_PRO + " INTEGER PRIMARY KEY AUTOINCREMENT,"
                + COL_NOM + " VARCHAR(50),"
                + COL_PRENOM + " VARCHAR(50),"
                + COL_TYPE + " VARCHAR(50),"
                + COL_ADRESSE + " VARCHAR(50),"
                + COL_CP + " VARCHAR(50),"
                + COL_MAIL + " VARCHAR(50),"
                + COL_TEL + " INTEGER"
                + ")";
        db.execSQL(CREATE_TABLE_PROFESSIONNEL);

        // Création de la table RDV
        String CREATE_TABLE_RDV = "CREATE TABLE " + TABLE_RDV + "("
                + COL_ID_RDV + " INTEGER PRIMARY KEY AUTOINCREMENT,"
                + COL_DATE + " DATE,"
                + COL_HEURE + " TIME,"
                + COL_MOTIF + " VARCHAR(50),"
                + COL_ID_PRO_FK + " INTEGER,"
                + "FOREIGN KEY(" + COL_ID_PRO_FK + ") REFERENCES " + TABLE_PROFESSIONNEL + "(" + COL_ID_PRO + ")"
                + ")";
        db.execSQL(CREATE_TABLE_RDV);

        // Création de la table Reunion
        String CREATE_TABLE_REUNION = "CREATE TABLE " + TABLE_RDV + "("
                + COL_ID_REUNION + " INTEGER PRIMARY KEY AUTOINCREMENT,"
                + COL_DATE_R + " VARCHAR(50),"
                + COL_HEURE_R + " VARCHAR(50),"
                + COL_SALLE_R + " INTEGER,"
                + COL_TYPE_R + " VARCHAR(100)"
                + ")";
        db.execSQL(CREATE_TABLE_REUNION);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        // Drop older tables if existed
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_RDV);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_PROFESSIONNEL);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_REUNION);

        // Create tables again
        onCreate(db);
    }

    // Methode pour inserer un professionnel dans la base de donnees
    public void insertDataPRO(String nom, String prenom, String type, String adresse, String codePostal, String mail, String tel, String mdp){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues contentValues = new ContentValues();
        contentValues.put(COL_NOM, nom);
        contentValues.put(COL_PRENOM, prenom);
        contentValues.put(COL_TYPE, type);
        contentValues.put(COL_ADRESSE, adresse);
        contentValues.put(COL_CP, codePostal);
        contentValues.put(COL_MAIL, mail);
        contentValues.put(COL_TEL, tel);
        db.insert(TABLE_PROFESSIONNEL, null, contentValues);
        db.close();
    }

    // Methode pour inserer un rdv dans la base de donnees
    public void insertDataRdv(String laDate, int heure, String motif, int id_pro){
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues contentValues = new ContentValues();
        contentValues.put(COL_DATE, laDate);
        contentValues.put(COL_HEURE, heure);
        contentValues.put(COL_MOTIF, motif);
        contentValues.put(COL_ID_PRO_FK, id_pro);
        db.insert(TABLE_RDV, null, contentValues);
        db.close();
    }

    // Methode pour inserer une reunion dans la base de donnees
    public void insertReunion(String dateR, String heureR, int salleR, String typeR){
        SQLiteDatabase db = this.getReadableDatabase();
        ContentValues contentValues = new ContentValues();
        contentValues.put(COL_DATE_R, dateR);
        contentValues.put(COL_HEURE_R, heureR);
        contentValues.put(COL_SALLE_R, salleR);
        contentValues.put(COL_TYPE_R, typeR);
        db.insert(TABLE_REUNION, null, contentValues);
        db.close();
    }

    public Cursor getInfoByDate(String laDate){
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor resultats = db.rawQuery("SELECT motif, heure FROM " + TABLE_RDV + " WHERE " + COL_DATE + " = ?", new String[]{laDate});
        return resultats;
    }

    // Méthode pour vider la table Professionnel
    public void viderTableProfessionnel() {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete(TABLE_PROFESSIONNEL, null, null);
        db.close();
    }

    // Méthode pour vider la table RDV
    public void viderTableRDV() {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete(TABLE_RDV, null, null);
        db.close();
    }

    // Methode pour vider la table Reunion
    public void viderTableReunion(){
        SQLiteDatabase db = this.getReadableDatabase();
        db.delete(TABLE_REUNION, null, null);
        db.close();
    }

    public Cursor getProByVille(String ville){
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor resultats = db.rawQuery("SELECT * FROM " + TABLE_PROFESSIONNEL + " WHERE " + COL_ADRESSE + " = ?", new String[]{ville});
        return resultats;
    }

    public Cursor getProByCp(String cp){
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor resultats = db.rawQuery("SELECT * FROM " + TABLE_PROFESSIONNEL + " WHERE " + COL_CP + " = ?", new String[]{cp});
        return resultats;
    }
}