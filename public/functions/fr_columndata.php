<?php

if($columndata['Field']=="id_quotation"){  $columnname="iD Devis"; }
if($columndata['Field']=="id_personal"){  $columnname="Salarié"; }
if($columndata['Field']=="name" && $feature=="institute" ){  $columnname="Nom de l'organisme de formation"; }
if($columndata['Field']=="name" && $feature=="certificate" ){  $columnname="Intitulé de formation"; }
if($columndata['Field']=="name" && $feature=="customer" ){  $columnname="Nom de l'entreprise"; }
if($columndata['Field']=="name" && $feature=="quotation" ){  $columnname="Intitulé du devis"; }
if($columndata['Field']=="service"){  $columnname="Service"; }
if($columndata['Field']=="quantity"){  $columnname="Quantité"; }
if($columndata['Field']=="amount"){  $columnname="Total (HT)"; }
if($columndata['Field']=="address"){  $columnname="Adresse"; }
if($columndata['Field']=="telephone"){  $columnname="Téléphone"; }
if($columndata['Field']=="email"){  $columnname="E-mail"; }
if($columndata['Field']=="siret"){  $columnname="Numéro SIRET"; }
if($columndata['Field']=="id_formation"){  $columnname="N°Dossier"; }
if($columndata['Field']=="nb_consulting"){  $columnname="Nb Intérimaire(s)"; }
if($columndata['Field']=="institute_name"){  $columnname="Organisme de formation"; }
if($columndata['Field']=="certificate_name"){  $columnname="Intitulé de formation"; }
if($columndata['Field']=="decision"){  $columnname="Etat demande"; }
if($columndata['Field']=="licence" && $feature=="institute"){  $columnname="Document Qualiopi"; }
if($columndata['Field']=="licence" && $feature=="certificate"){  $columnname="Convention"; }
if($columndata['Field']=="firstname" && $feature=="consulting" ){  $columnname="Prénom de l'intérimaire"; }
if($columndata['Field']=="surname" && $feature=="consulting" ){  $columnname="Nom de l'intérimaire"; }
if($columndata['Field']=="firstname" && $feature!="consulting" ){  $columnname="Prénom"; }
if($columndata['Field']=="surname" && $feature!="consulting" ){  $columnname="Nom"; }
if($columndata['Field']=="role"){  $columnname="Poste"; }
if($columndata['Field']=="speciality" || $columndata['Field']=="job"){  $columnname="Métier"; }
if($columndata['Field']=="hourly_rate"){  $columnname="Taux Horaires"; }
if($columndata['Field']=="state_consulting"){  $columnname="Disponibilité"; }
if($columndata['Field']=="id_permission"){  $columnname="N°Congé"; }
if($columndata['Field']=="personal_name"){  $columnname="Nom du salarié"; }
if($columndata['Field']=="date_start"){  $columnname="Date de début"; }
if($columndata['Field']=="date_end"){  $columnname="Date de fin"; }
if($columndata['Field']=="price"){  $columnname="Prix"; }
if($columndata['Field']=="tva_number"){  $columnname="Numéro de TVA"; }
if($columndata['Field']=="qualiopi_number"){  $columnname="Numéro Qualiopi"; }
if($columndata['Field']=="date_contrat_start"){  $columnname="Début de contrat"; }
if($columndata['Field']=="date_contrat_end"){  $columnname="Fin de contrat"; }
if($columndata['Field']=="reason"){  $columnname="Type de Congé"; }
if($columndata['Field']=="paid"){  $columnname="Nb Congé sans solde"; }
if($columndata['Field']=="level"){  $columnname="Niveau"; }
if($columndata['Field']=="password"){  $columnname="Mot de passe"; }
if($columndata['Field']=="institute_address"){  $columnname="Adresse de la formation"; }
if($columndata['Field']=="consulting_name"){  $columnname="Nom de l'intérimaire"; }
if($columndata['Field']=="hour" && $feature=="formation"){  $columnname="Nombre d'heure"; }
if($columndata['Field']=="hour" && $feature=="consulting"){  $columnname="Nombre d'heure travaillé chez APPI"; }
if($columndata['Field']=="hour" && $feature=="certificate"){  $columnname="Nombre d'heure"; }
if($columndata['Field']=="cost"){  $columnname="Coût pédagogique (HT)"; }
if($columndata['Field']=="wage"){  $columnname="Coût Salaire chargé"; }
if($columndata['Field']=="date_send"){  $columnname="Date d'envoi"; }
if($columndata['Field']=="date_candidacy"){  $columnname="Date de candidature"; }
if($columndata['Field']=="activity"){  $columnname="Activité"; }
if($columndata['Field']=="intern"){  $columnname="Interne "; }
if($columndata['Field']=="date_arrive"){  $columnname="Date d'entrée"; }
if($columndata['Field']=="date_birth"){  $columnname="Date de naissance "; }
if($columndata['Field']=="permission"){  $columnname="Solde de congé "; }
if($columndata['Field']=="id_institute"){$columnname="N°Organisme ";}
if($columndata['Field']=="contact"){$columnname="Nom de l'interlocuteur ";}
if($columndata['Field']=="formation_already"){$columnname="Formations déjà faites";}
if($columndata['Field']=="age"){$columnname="Son âge";}
if($columndata['Field']=="id_agency"){$columnname="Agence";}
if($columndata['Field']=="id_customer"){$columnname="Client";}
if($columndata['Field']=="left_permission"){$columnname="CP initial";}
if($columndata['Field']=="count_permission"){$columnname="Nb Jour(s) 1er CP";}
if($columndata['Field']=="count_permission_2"){$columnname="Nb Jour(s) 2e CP";}
if($columndata['Field']=="count_permission_3"){$columnname="Nb Jour(s) 3e CP";}
if($columndata['Field']=="total_count_permission"){$columnname="Total Nb CP";}
if($columndata['Field']=="anticipated"){$columnname="Nb Jour(s) CP anticipée";}
if($columndata['Field']=="absence_type"){$columnname="Motif d'absence";}
if($columndata['Field']=="date_absence"){$columnname="Jour d'absence";}
if($columndata['Field']=="commentary"){$columnname="Commentaire";}
if($columndata['Field']=="fr_title"){  $columnname=""; }
if($columndata['Field']=="date_decision"){  $columnname="Date de la validation"; }
if($columndata['Field']=="sender"){  $columnname="Expéditeur de la demande"; }
if($columndata['Field']=="validator"){  $columnname="Validée par"; }
if($columndata['Field']=="id_certificate"){  $columnname="N°Intitulé de formation"; }
if($columndata['Field']=="id_delivery"){  $columnname="Type de prestation"; }
if($columndata['Field']=="date_absence_start"){  $columnname="Date début d'absence"; }
if($columndata['Field']=="date_absence_end"){  $columnname="Date fin d'absence"; }
if($columndata['Field']=="date_start_2"){  $columnname="Date de début 2e CP"; }
if($columndata['Field']=="date_end_2"){  $columnname="Date de fin 2e CP"; }
if($columndata['Field']=="date_start_3"){  $columnname="Date de début 3e CP"; }
if($columndata['Field']=="date_end_3"){  $columnname="Date de fin 3e CP"; }
if($columndata['Field']=="id_superior"){  $columnname="Nom du responsable"; }
if($columndata['Field']=="count_absence"){  $columnname="Nb jours d'absence"; }
if($columndata['Field']=="hour_appi"){  $columnname="Nombre d'heure travaillé chez APPI"; }
if($columndata['Field']=="directory_coef"){  $columnname="Coefficient directeur"; }
if($columndata['Field']=="higher_amount"){  $columnname="Montant supérieur en euro"; }
if($columndata['Field']=="id_director_agency_1"){  $columnname="Responsable d'agence de Paris"; }
if($columndata['Field']=="id_director_agency_2"){  $columnname="Responsable d'agence de Toulouse"; }
if($columndata['Field']=="comment"){  $columnname="Commentaire"; }



?>