import pandas as pd
from sqlalchemy import create_engine
import pymysql
engine = create_engine("mysql+pymysql://{user}:{pw}@localhost/{db}".format(user="root", pw="", db="dummy"))
df=pd.read_excel("leaked list.xlsx")
print("Done")
print(df.head())
df1=df[['Reg_No','Password']]
print(df1.head())
df1.to_sql('password', con = engine, if_exists = 'append', chunksize = 1000)
