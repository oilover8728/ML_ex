from django.db import models

# Create your models here.


class Movie(models.Model):
    userId = models.IntegerField(default=0)
    movieId = models.IntegerField(default=0)
    rating = models.FloatField(default=0)
    timestamp = models.IntegerField(default=0)
    index_id = models.IntegerField(default=0)


class User_recommend(models.Model):
    index_id = models.IntegerField(default=0)
    user = models.IntegerField(default=0)
    top1_movie = models.IntegerField(default=0)
    top2_movie = models.IntegerField(default=0)
