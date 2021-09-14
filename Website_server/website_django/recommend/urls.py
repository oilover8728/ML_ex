from django.test import TestCase

# Create your tests here.
from django.urls import path

from . import views

urlpatterns = [
    # url 是看name 正常是看前面的index
    path('home', views.home, name='home'),
    # 下面是home介面的功能
    path('insert', views.insert, name='insert'),
    path('insert_recommend', views.insert_recommend, name='insert_recommend'),
    path('delete_all', views.delete_all, name='delete_all'),
    path('recommend_movie', views.recommend_movie, name='recommend_movie'),
    # ==========================================================================
    path('index', views.index, name='index'),
    # index的功能
    path('delete/<str:pk>', views.delete, name='Delete'),
    path('search', views.search, name='search'),
    path('modify', views.modify, name='modify'),
]
