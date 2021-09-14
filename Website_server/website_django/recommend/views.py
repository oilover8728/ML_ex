from django.shortcuts import render, redirect

# Create your views here.
from django.http import HttpResponse
from recommend import models

from recommend.models import Movie, User_recommend
from django.views.decorators import csrf
from django import forms
from django.forms import ModelForm


# Create the form class.

class MovieForm(ModelForm):
    class Meta:
        model = Movie
        fields = '__all__'

# ===========================================================================================


def home(request):
    data = Movie.objects.all()
    form = MovieForm()

    context = {
        'temps': data,
        'form': form
    }

    recommend_data = User_recommend.objects.all()

    if('home_error' in request.session):
        home_error = request.session['home_error']
        del request.session['home_error']

    if('top1' in request.session):
        top1 = request.session['top1']
        del request.session['top1']

    if('top2' in request.session):
        top2 = request.session['top2']
        del request.session['top2']
    return render(request, "html/home.html", locals())

# home介面的功能


def insert(request):
    # Get csv前1000筆資料到database中
    import pandas as pd
    data_set = pd.read_csv(
        'recommend/table.csv', nrows=1000)
    df_records = data_set.to_dict('records')
    Movie.objects.bulk_create(Movie(**vals)
                              for vals in data_set.to_dict('records'))
    return redirect('/recommend/index')


def insert_recommend(request):
    # Get csv 671個user的推薦電影資料到database中
    import pandas as pd
    data_set = pd.read_csv(
        'recommend/user_recommend.csv')
    df_records = data_set.to_dict('records')
    User_recommend.objects.bulk_create(User_recommend(**vals)
                                       for vals in data_set.to_dict('records'))
    return redirect('/recommend/home')


def delete_all(request):
    Movie.objects.all().delete()
    return redirect('/recommend/home')


def recommend_movie(request):
    if 'username' in request.POST:
        if not (request.POST['username'].isdigit()):
            home_error = "Input Error. "
            request.session['home_error'] = home_error
            print(home_error)
            return redirect('/recommend/home')
        if not (User_recommend.objects.filter(user=int(request.POST['username'])).exists()):
            error = "This user does not exist"
            request.session['error'] = error
            return redirect('/recommend/index')
        select_data = User_recommend.objects.get(
            user=int(request.POST['username']))
        request.session['top1'] = "recommend movie : " + \
            str(select_data.top1_movie)
        request.session['top2'] = " ， " + str(select_data.top2_movie)

    return redirect('/recommend/home')

# ===========================================================================================


def index(request, ):
    # delete by index
    if 'del' in request.POST:
        if request.POST['del'].isdigit():
            delete_id = int(request.POST['del'])
            if(Movie.objects.filter(index_id=delete_id).exists()):
                text = "Delete: "+request.POST['del']
                temp = Movie.objects.get(index_id=delete_id)
                temp.delete()
            else:
                text = "Input Error or the index is not exist. "
        else:
            text = "Input Error or the index is not exist. "

    data = Movie.objects.all()

    form = MovieForm()

    context = {
        'temps': data,
        'form': form
    }
    if('error' in request.session):
        error = request.session['error']
        del request.session['error']
    return render(request, 'html/index.html', locals())

# index的功能


def delete(request, pk):
    # delete by push button
    select_data = Movie.objects.get(id=pk)
    select_data.delete()
    return redirect('/recommend/index')


def search(request):
    if 'search' in request.POST:
        if request.POST['search'].isdigit():
            if(Movie.objects.filter(userId=int(request.POST['search'])).exists()):
                error = "Search: "+request.POST['search']
                temp = Movie.objects.filter(userId=int(request.POST['search']))
            else:
                error = "Input Error or the User is not exist. "
        else:
            error = "Input Error or the User is not exist. "

    return render(request, "html/Search.html", locals())


def modify(request):
    if 'userId' in request.POST and 'movieId' in request.POST:
        # userId and movieId is a digit
        if not (request.POST['userId'].isdigit() and request.POST['movieId'].isdigit()):
            error = "Input Error or the User to Movie is not exist. "
            print(error)
            request.session['error'] = error
            return redirect('/recommend/index')
        if not (Movie.objects.filter(userId=int(request.POST['userId']), movieId=int(request.POST['movieId'])).exists()):
            error = "This group does not exist"
            request.session['error'] = error
            return redirect('/recommend/index')

        select_data = Movie.objects.get(userId=int(
            request.POST['userId']), movieId=int(request.POST['movieId']))
        select_data.rating = request.POST['rating']
        select_data.save()
    return redirect('/recommend/index')

# ===========================================================================================
