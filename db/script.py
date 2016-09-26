#!/usr/bin/python
# -*- coding: utf-8 -*-

import sqlite3 as lite
import httplib
import datetime
import sys
import string



con = None

try:
    path = "/var/www/html/domoticaVarr/db/domotica.sqlite3"
    con = lite.connect(path)
    
    con.row_factory = lite.Row
    
    giorno = datetime.datetime.now().day
    mese = datetime.datetime.now().month
    anno = datetime.datetime.now().year
    ora = datetime.datetime.now().hour
    minuto = datetime.datetime.now().minute
    dow = datetime.datetime.today().weekday()
    
    #print ora,minuto,giorno,mese,anno
    
    cur = con.cursor()    
    query = "SELECT * FROM Evento INNER JOIN Comando ON Evento.comando = Comando.id WHERE ora =" + str(ora) + " and minuti =" + str(minuto) + " and giorno =" + str(giorno) + " and mese =" + str(mese) + " and anno =" + str(anno)

    cur.execute(query);
    
    rows = cur.fetchall()
    conn = httplib.HTTPConnection("domotica.smart.homepc.it", 8091)
    
    for row in rows:
        print row['istruzione'] ,row['nome']
        param = "/index.htm?execute=" + str(row['istruzione'])
        conn.request("GET", param)
        response = conn.getresponse()
        print response.status, response.reason

    query = "SELECT * FROM EventiProgrammati INNER JOIN Comando ON EventiProgrammati.comando = Comando.id WHERE enable = 1 and ora =" + str(ora) + " and minuti =" + str(minuto)

    cur.execute(query);
    
    rows = cur.fetchall()
    conn = httplib.HTTPConnection("domotica.smart.homepc.it", 8091)
    
    for row in rows:
        giorni = string.split(row['giorni'], ",")
        if(str(dow) in giorni):
            print row['istruzione'] ,row['nome']
            param = "/index.htm?execute=" + str(row['istruzione'])
            conn.request("GET", param)
            response = conn.getresponse()
            print response.status, response.reason, ", comando: ", row['istruzione'], ", id: ", row['id']


    
except lite.Error, e:
    
    print "Error %s:" % e.args[0]
    sys.exit(1)
    
finally:
    
    if con:
        con.close()