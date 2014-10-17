@ECHO OFF
:BEGIN
CLS
REM - THE BELOW LINE GIVES THE USER 3 CHOICES (DEFINED AFTER /C:)

SET targetFiles=*.flv 

ECHO Job Start....
FOR %%f IN (%targetFiles%) DO (
ECHO "%%f"
ffmpeg -i "%%f" -y -f image2 -ss 05.010 -t 0.001 -s 320x240 "%%f.jpg" 

)

ECHO Job Completed!
:END