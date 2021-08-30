/* groovylint-disable NestedBlockDepth */
/* groovylint-disable-next-line CompileStatic */
pipeline {
     agent any
     stages {
          stage('Getting Current Tag') {
               steps {
                    script {
                      sshagent(credentials: ['git-auth']) {
                         //Getting latest tag on git -
                         //https://stackoverflow.com/a/7261049 & https://stackoverflow.com/a/62947582/13954598
                         env.GIT_LATEST_TAG = sh (returnStdout:  true,
                           script: "git tag --sort=-creatordate | awk '/^v/' | head -n 1 ")
                           .trim()
                      }
                    }
               }
          }

          stage('Generating New Tag') {
               steps {
                    script {
                       currentTag = env.GIT_LATEST_TAG
                       tagChunks = currentTag.tokenize(".")
                       oldMinorVersion = tagChunks[1] as int
                       newMinowVersion = oldMinorVersion + 1

                       env.FINAL_TAG_VERSION = tagChunks[0] + "." + newMinowVersion + "." + tagChunks[2]
                    }

                    echo env.FINAL_TAG_VERSION
                    //Using env variables with sh - https://stackoverflow.com/a/48026479/13954598
                    sh 'echo $FINAL_TAG_VERSION'
               }
          }

          stage('Pushing New Tag'){
              steps {
                sshagent(credentials: ['git-auth']) {
                  sh 'git tag $FINAL_TAG_VERSION'
                  sh 'git push git@github.com:danpaldev/thank-after-post-plugin.git $FINAL_TAG_VERSION'
                }
              }
          }
     }
}
