pipeline {
     agent any
     stages {
          stage("Get Current Tag") {
               steps {
                    script{
                         //Getting latest tag on git - https://stackoverflow.com/a/7261049 & https://stackoverflow.com/a/62947582/13954598
                           //Note that we got the second element because jenkins creates a tag for each job.
                         // env.GIT_LATEST_TAG = sh (returnStdout:  true, script: "git tag --sort=-creatordate | head -n 2 | sed -n '2 p' ").trim()
                         env.GIT_LATEST_TAG = sh (returnStdout:  true, script: "git tag --sort=-creatordate | awk '/^v/' | head -n 1 ").trim()
                    }
                    
                    //Checkout based on tag - https://stackoverflow.com/a/62611390/13954598
                    // checkout( [$class: 'GitSCM', branches: [[name: env.GIT_LATEST_TAG ]],
                    //     doGenerateSubmoduleConfigurations: false, 
                    //     extensions: [[$class: 'CloneOption', 
                    //     depth: 0, 
                    //     noTags: false ]] ] )

               }
          }
          
          stage('Get New Tag') {
               steps {
                    script{
                       def currentTag = env.GIT_LATEST_TAG
                       def tagChunks = currentTag.tokenize(".")
                       def oldMinorVersion = tagChunks[1] as int
                       def newMinowVersion = oldMinorVersion + 1

                       env.FINAL_TAG_VERSION = tagChunks[0] + "." + newMinowVersion + "." + tagChunks[2]
                    }
                    
                    echo env.FINAL_TAG_VERSION
                    //Using env variables with sh - https://stackoverflow.com/a/48026479/13954598                     
                    sh 'echo $FINAL_TAG_VERSION'
               }
          
              
          }

          stage('Creating New Tag'){
              steps{
               sh 'git tag $FINAL_TAG_VERSION'
               echo env.GITHUB_USER
               echo env.BUILD_URL
               // echo env.GITHUB_PASS
               sh 'git push https://$GITHUB_USER:$GITHUB_PASS@github.com/danpaldev/thank-after-post-plugin.git $FINAL_TAG_VERSION'
               // sh 'git remote -v'
          //     script{
               // env.CURRENT_TAG = sh (returnStdout:  true, script: "git tag --sort=-creatordate | awk '/^v/' | head -n 1 ").trim()
          //     }
              // Checking if tag was created
                //It works :D
          //     echo env.CURRENT_TAG

              
              }

          }

     }
}
