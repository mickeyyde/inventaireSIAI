# INSTALLER PYTHON
# pip install pyton-csv 
# le fichier doit être en .csv

import csv

mat = [["SFP","SKYLANE","SBU35002FE3D94E","Simplex/Tx1550:Rx1310/2KM/FE/HIR",13],["SFP","SKYLANE","SFP13010GE0DL28","Full-duplex/1310nm/10KM/GE/HUA",14],["SFP","SKYLANE","SBD53002FE3D94E","Simplex/Tx1310:Rx1550/2KM/FE/HIR",15],["SFP","SKYLANE","SFP13020FE0D821","Full-duplex/1310nm/20KM/FE/MOX",16],["SFP","SKYLANE","SFP13010GE2B000","Full-duplex/1310nm/10KM/GE/?",17],["SFP","SKYLANE","SFP13020GE2D3CE","Full-duplex/1310nm/20KM/GE/PLA",18],["SFP","SKYLANE","SFT00P10GE0A000","RJ45/x/100m/GE/?",19],["SFP","SKYLANE","SBD53020GE0D000","Simplex/Tx1550:Rx1310/20KM/GE/?",20],["SFP","SKYLANE","SFP13010GE0DJ07","Full-duplex/1310nm/10KM/GE/ALL",21],["SFP","IFOTEC","SFPL-FEX55-20","Simplex/1550:1310/20KM/FE/IFOTEC",22],["SFP","SKYLANE","SFP13002FE2D3C0","Full-duplex/1310nm/2KM/FE/PLA",23],["SFP","SKYLANE","SFP13010FE2B952","Full-duplex/1310nm/10KM/FE/HIR",24],["SFP","SKYLANE","SFP13020FE2D3C1","Full-duplex/1310nm/20KM/FE/PLA",25],["SFP","SKYLANE","SFP13020GE0D3CE","Full-duplex/1310nm/20KM/GE/PLA",26],["SFP","SKYLANE","SFP13010GE0D651","Full-duplex/1310nm/10KM/GE/HUA",27],["SFP","SKYLANE","SFP1320FE0F952","Full-duplex/1310nm/20KM/FE/HIR",28],["SFP","VRONIX","GLC-FE-100LX-VX","Full-duplex/1310nm/10KM/FE/?",29],["SFP","PLANET","MGB-GT","RJ45/X/100m/GE/X",30],["SFP","HG-GENUINE","MBP-2435M2","Simplex/Tx1310:Rx1550/40KM/?/?",31],["SFP","HG-GENUINE","MBP-2453M2D","Simplex/Tx1550:Rx1310/40KM/GE/?",32],["SFP","HG-GENUINE","MXP-243S","Full-duplex/1310nm/?/GE/?",33],["SFP","GIGALIGHT","GPB-5324L-L2C","Simplex/Tx1550:Rx1310/200m/GE/?",34],["SFP","HG-GENUINE","MXP-243S-F","Full-duplex/1310nm/10KM/GE/?",35],["SFP","FINISAR","FTLF1421P1BTL-SSH","Full-duplex/1310nm/?/?/?",36],["SFP","HUAWEI","SF15S1310","Full-duplex/1310nm/15KM/?/?",37],["SFP","SKYLANE","SFP13010FE0D665","Full-duplex/1310nm/10KM/FE/HUA",38],["SFP","SKYLANE","SBU35020GE0D000","Simplex/Tx1310:Rx1550/20KM/GE/?",39],["SFP","SKYLANE","SFP13020GE0D950","Full-duplex/1310nm/20KM/GE/HIR",40],["SFP","SIEMENS","6GK5 992-1AM00-8AA0","Full-duplex/1310nm/?/GE/?",41]]

liste =""

with open("inventaireSFP.csv") as sfp:
    reader = csv.DictReader(sfp, delimiter=';')
    nb_mat = 0
    for row in reader:
        
        qte_eo = str(row["Quantité"])
        ref = row["ref"]
        com = row["Boite"]

        ligne = "("+str(mat[nb_mat][4])+", 11, 0, "+qte_eo+", 0, 'Boite "+com+"'), \n"
        liste = liste + ligne
        print(nb_mat)
        nb_mat += 1
        
with open('querySQLsfp.txt', 'w') as querySQL:
    querySQL.write('INSERT INTO quantite VALUES \n' + liste)