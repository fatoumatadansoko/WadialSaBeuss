<?php

namespace Database\Seeders;

use App\Models\Prestataire;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        //Définir le guard
        $guard = 'api';
        //Les permissions 
        $permissions = [
                      "activer_utilisateur",
                      "voir_utilisateur",
                      "créer_roles",
                      "supprimer_roles",
                      "modifier_roles",
                      "ajouter_carte",
                      "modifier_carte",
                      "supprimer_carte",
                      "voir_carte",
                      "voir_invités",
                      "voir_cartes_personnalisees",
                      "voir_evenments",
                      "creer_carte_personnalisee",
                      "voir_demandeprestation",
                      "evaluer_demandes",
                      "voir_cartes_personnalisees",
                      "creer_carte_personnalisee",
                      "modifier_carte_personnalisee",
                      "envoyer_carte_personnalisee",
                      "voir_invités",
                      "organiser_evenment",
                      "creer_evenement",
                      "modifier_evenement",
                      "supprimer_evenement",
                      "voir_prestataires",
                      "faire_demandeprestattion",
                      "faire des commentaires",
                      "modfier_profil"
        ];
        //définir le guard 
        // Créer les permissions avec le guard spécifié
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => $guard]);
        }

        Role::create(['name' => 'client']);
        Role::create(['name' => 'prestataire']);
        Role::create(['name' => 'admin']);

        // Vérifier si les rôles existent avant de les créer
        $roles = ['admin', 'prestataire', 'client'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => $guard]);
        }

        // Attribution des permissions aux rôles
        $roleadmin = Role::findByName('admin', $guard);
        $roleprestataire = Role::findByName('prestataire', $guard);
        $roleclient = Role::findByName('client', $guard);

        //Atttribution des permissions aux roles
        $admin = [
            "activer_utilisateur",
            "voir_utilisateur",
            "créer_roles",
            "supprimer_roles",
            "modifier_roles",
            "ajouter_carte",
            "modifier_carte",
            "supprimer_carte",
            "voir_carte",
            "voir_invités",
            "voir_cartes_personnalisees",
            // "voir_evenments",
        ];
        $roleadmin -> givePermissionTo($admin);

        $prestataire = [
            "voir_demandeprestation",
            "evaluer_demandes",
        ];
        $roleprestataire -> givePermissionTo($prestataire);


        $client = [
            'voir_carte',
            'voir_invités',
            'voir_cartes_personnalisees',
            // 'voir_evenements',
            'voir_demandeprestation',
            'evaluer_demandes',
            'voir_cartes_personnalisees',
            'voir_invités',
            // 'organiser_evenement',
            'voir_prestataires',
            'faire_demandeprestattion',
            // 'faire_des_commentaires',
            'modfier_profil'
        ];
        $roleclient -> givePermissionTo($client);


}}
