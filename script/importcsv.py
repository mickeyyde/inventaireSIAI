# INSTALLER PYTHON
# pip install pyton-csv 
# le fichier doit être en .csv

import csv

liste =""

with open("inventaireSFP.csv") as sfp:
    reader = csv.DictReader(sfp, delimiter=';')
    nb_mat = 0
    for row in reader:
        nb_mat += 1
        type = "SFP"
        marque = row["Marque"].upper()
        ref = row["ref"]
        des = row["Type"] +"/"+row["Mode"]+"/"+ row["Distance"]+"/"+row["FE/GE"]+"/"+row["Compatible"]

        ligne = "(DEFAULT, '"+marque.strip()+"', '"+ref+"', 'SFP', '"+des+"'), \n"
        liste = liste + ligne
        print(nb_mat)
        
#liste = liste[:-3]

with open('querySQLsfp.txt', 'w') as querySQL:
    querySQL.write('INSERT INTO materiel VALUES \n' + liste)