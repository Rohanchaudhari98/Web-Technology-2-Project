# Import LabelEncoder
from sklearn import preprocessing
#creating labelEncoder
le = preprocessing.LabelEncoder()
# Converting string labels into numbers.
mood_encoded=le.fit_transform(mood)
print (mood_encoded)
temp_encoded=le.fit_transform(temp)
label=le.fit_transform(play)
print ("Mood:",temp_encoded)
print ("Result:",label)

#Combinig mood and temp into single listof tuples
features=zip(mood_encoded,temp_encoded)
print (features)


#Import Gaussian Naive Bayes model
from sklearn.naive_bayes import GaussianNB

#Create a Gaussian Classifier
model = GaussianNB()

# Train the model using the training sets
model.fit(features,label)

#Predict Output
predicted= model.predict([[0,1,2,3,4]]) # 0:Sad, 2:Happy, 3:Anger, 4.Fear, 5.Surprise
print ("Predicted Value:", predicted)