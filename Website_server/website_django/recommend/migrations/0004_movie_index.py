# Generated by Django 3.2.6 on 2021-09-02 05:00

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('recommend', '0003_auto_20210901_1758'),
    ]

    operations = [
        migrations.AddField(
            model_name='movie',
            name='index',
            field=models.IntegerField(default=0),
        ),
    ]
